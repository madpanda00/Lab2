<?php

class Posts {

    public static function getPostsItemById( $id ) {
        $id = intval( $id );
        $db = Db::getCannection();

        if ( $id ) {
            $post = array();
            $sql = "SELECT name_users, header_page, text_page, date_page FROM Users, Page WHERE Users.email_users = Page.email_user AND Page.id_page = :id_page";
            $query = $db->prepare( $sql );
            $query->execute( ['id_page' => $id] );
            $row = $query->fetch();

            $post['header'] = $row['header_page'];
            $post['text'] = $row['text_page'];
            $post['author'] = $row['name_users'];
            $post['date'] = date( "d.m.y H:i", strtotime( $row['date_page'] ) );

            return $post;
        }
    }

    public static function getPostsFilesById( $id ) {
        $id = intval( $id );
        $db = Db::getCannection();

        if ( $id ) {
            $sql = "SELECT name_file FROM Files, Page WHERE Files.id_page = Page.id_page AND Page.id_page = :id_page";
            $query = $db->prepare( $sql );
            $query->execute( ['id_page' => $id] );
            $files = array();
            $i = 0;

            while( $row = $query->fetch() ) {
                $files[$i] = $row['name_file'];
                $str = strpos( $files[$i], "@" ) + 1;
                $files[$i] = substr( $files[$i], $str );
                $i++;
            }
            return $files;
        }
    }

    public static function getPostsList() {
        $db = Db::getCannection();
        $list = array();

        $sql = "SELECT id_page, name_users, header_page, text_page, date_page FROM Users, Page WHERE Users.email_users = Page.email_user ORDER BY date_page DESC";
        $query = $db->query( $sql );
        $i = 0;

        while( $row = $query->fetch() ) {
            $list[$i]['id'] = $row['id_page'];
            $list[$i]['name'] = $row['name_users'];
            $list[$i]['header'] = $row['header_page'];
            $list[$i]['text'] = $row['text_page'];

            if ( mb_strlen( $list[$i]['text'] ) > 180 ) {
                $list[$i]['shorttext'] = mb_strimwidth( $list[$i]['text'], 0, 180 );
                $list[$i]['shorttext'] = rtrim( $list[$i]['shorttext'], "!,.-" );
                $list[$i]['shorttext'] = substr( $list[$i]['shorttext'], 0, strrpos( $list[$i]['shorttext'], ' ' ) );
                $list[$i]['shorttext'] = $list[$i]['shorttext'] . "...";
            } else {
                $list[$i]['shorttext'] = $list[$i]['text'];
            }
            $list[$i]['date'] = date( "d.m.y H:i", strtotime( $row['date_page'] ) );
            $i++;
        }
        return $list;
    }

    public static function downloadFiles( $id ) {
        $id = intval( $id );
        $db = Db::getCannection();

        $sql = "SELECT name_file FROM Files, Page WHERE Files.id_page = Page.id_page AND Page.id_page = :id_page";
        $query = $db->prepare( $sql );
        $query->execute( ['id_page' => $id] );
        $files = array();
        $i = 0;

        while( $row = $query->fetch() ) {
            $files[$i]['path'] = $row['name_file'];
            $str = strpos( $files[$i]['path'], "@" ) + 1;
            $files[$i]['name'] = substr( $files[$i]['path'], $str );
            $i++;
        }

        $count = count( $files );

        if ( $count > 1 ) {
            $zip = new ZipArchive();
            $name = "PostFiles.zip";
            $zip->open( $name, ZIPARCHIVE::CREATE );

            foreach ( $files as $key ) {
                $zip->addFile( $key['path'], $key['name'] );
            }
            $zip->close();
        } else {
            $name = $files[0]['path'];
        }

        if ( file_exists( $name ) ) {
            if ( ob_get_level() ) {
                ob_end_clean();
            }

            $filesType =  end( explode( ".", $name ) );

            if ( $count == 1 ) {
                $name = $files[0]['name'];
            }

            header( "Content-Description: File Transfer" );
            header( "Content-Type: $filesType" );
            header( "Content-Disposition: attachment; filename=" . basename( $name ) );
            header( "Expires: 0" );
            header( "Cache-Control: must-revalidate" );
            header( "Pragma: public" );
            header( "Content-Length: " . filesize( $name ) );
            readfile( $name );

            if ( $count > 1 ) {
                unlink( $name );
            }
        }
    }

    public static function Create() {
        $db = Db::getCannection();
        $email = Session::get( 'User' );

        if ( isset( $_POST['header'] ) && isset( $_POST['content'] ) ) {
            $header = filter_var( trim( $_POST['header'] ), FILTER_SANITIZE_STRING );
            $content = filter_var( trim( $_POST['content'] ), FILTER_SANITIZE_STRING );
            $phpdate = date( 'Y-m-d H:i:s' );
            $sqldate = date( 'Y-m-d H:i:s', strtotime( str_replace( '-', '/', $phpdate ) ) );

            $error = array(
                'msg' => "",
                'header' => $header,
                'content' => $content,
            );

            if ( mb_strlen( $header ) > 80 ) {
                $error['msg'] = "Слишком длинный заголовок";
                return $error;
            }

            $sql = "INSERT INTO Page (email_user, header_page, text_page, date_page) VALUES (:email, :header, :content, :sqldate)";
            $query = $db->prepare( $sql );
            $query->execute( ['email' => $email, 'header' => $header, 'content' => $content, 'sqldate' => $sqldate] );

            $sql = "SELECT id_page FROM Page ORDER BY id_page DESC LIMIT 1";
            $query = $db->query( $sql );
            $id_page = $query->fetch();
        }

        $allow = array( 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/vnd.ms-excel', 'application/zip', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'application/pdf', 'image/png', 'image/jpeg' );

        $directoryName = array( 'files1', 'files2', 'files3' );
        $finfo = new finfo( FILEINFO_MIME_TYPE );
        $total = count( $_FILES['filename']['name'] );

        for ( $i = 0; $i < $total; $i++ ) {
            if ( !in_array( $finfo->file( $_FILES["filename"]["tmp_name"][$i] ), $allow ) ) {
                $sql = "DELETE FROM Page WHERE Page.id_page = :id_page";
                $query = $db->prepare( $sql );
                $query->execute( ['id_page' => $id_page[0]] );
                $error['msg'] = "Неподдерживаемый формат файла. Поддерживаемые форматы: .doc, .docx, .pdf, .xls, xlsx, .png, .jpeg, .zip";
                return $error;
            }
            if ( $_FILES["filename"]["size"][$i] > 1024 * 1024 * 20 ) {
                $sql = "DELETE FROM Page WHERE Page.id_page = :id_page";
                $query = $db->prepare( $sql );
                $query->execute( ['id_page' => $id_page[0]] );
                $error['msg'] = "Привышен размер файла. Файл должен весить меньше 20мб";
                return $error;
            }
        }

        for ( $i = 0; $i < $total; $i++ ) {
            if ( $_FILES["filename"]["error"][$i] == UPLOAD_ERR_OK ) {
                $tmp_name = $_FILES["filename"]["tmp_name"][$i];
                $name = time() . "@" . $_FILES["filename"]["name"][$i];
                $directoryNumber = rand( 0, 2 );
                $uploads_dir = ROOT . '/files/' . $directoryName[$directoryNumber];

                if ( !is_dir( $uploads_dir ) ) {
                    $error['msg'] = "Такой директории не существует " . $uploads_dir;
                    $sql = "DELETE FROM Page WHERE Page.id_page = :id_page";
                    $query = $db->prepare( $sql );
                    $query->execute( ['id_page' => $id_page[0]] );
                    return $error;
                }
                $way = "$uploads_dir/$name";

                move_uploaded_file( $tmp_name, $way );
                $sql = "INSERT INTO Files (id_page, name_file) VALUES (:id_page, :namefile)";
                $query = $db->prepare( $sql );
                $query->execute( ['id_page' => $id_page[0], 'namefile' => $way] );
            } else {
                $error['msg'] = "Файл не был загружен.";
                return $error;
            }
            header( "Location: /post/" . $id_page[0] );
        }
    }
}