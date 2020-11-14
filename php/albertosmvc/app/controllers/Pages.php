<?php

class Pages extends Controller {

    public function __construct() {
        // aus dem extended Core Controller
        //$this->postModel = $this->model('Post');
    }

    public function index () {

        //$posts = $this->postModel->getPosts();

        $data = [
            'title' => 'Welcome',
        //    'posts' => $posts
        ];

        $this->view('pages/index', $data);
    }

    public function about () {

        $data = ['title' => 'About'];

        $this->view('pages/about', $data );
    }
}