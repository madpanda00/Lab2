<?php
include_once ROOT . '/models/Posts.php';

class PostController {

    public function actionList() {
        if ( Session::get( 'User' ) ) {
            $email = $_SESSION["User"];
        }

        $postsList = array();
        $postsList = Posts::getPostsList();

        require_once( ROOT . '/views/posts/index.php' );
        return true;
    }

    public function actionView( $params ) {
        if ( Session::get( 'User' ) ) {
            $email = $_SESSION["User"];

        } else {
            header( "Location: /post" );
        }

        $postsItemById = array();
        $postsFilesById = array();
        $postsItemById = Posts::getPostsItemById( $params );
        $postsFilesById = Posts::getPostsFilesById( $params );

        require_once( ROOT . '/views/posts/postsById.php' );
        return true;

    }

    public function actionDownload( $params ) {
        if ( !isset( $_SESSION["User"] ) ) {
            header( "Location: /post" );
        }

        Posts::downloadFiles( $params );
        return true;

    }

    public function actionCreate() {
        if ( Session::get( 'User' ) ) {
            $email = $_SESSION["User"];
        } else {
            header( "Location: /post" );
        }

        $error = Posts::Create();

        require_once( ROOT . '/views/posts/postCreate.php' );
        return true;

    }

}