<?php
class Posts extends Controller
{

    public function __construct()
    {
        if (!isLoggedIn()) {
            redirect('users/login');
        };
        $this->postModel = $this->loadModel('Post');
    }

    public function index()
    {
        // Get Posts
        $posts = $this->postModel->getPosts();
        $data = [
            'posts' => $posts,
            'active' => 'home',
        ];
        $this->loadView('posts/index', $data);
    }

    // Show Post
    public function show($id)
    {
        $post = $this->postModel->getPostById($id);
        $data = [
            'post' => $post,
            'active' => 'home',
        ];
        $this->loadView('posts/show', $data);
    }

    // Add Post
    public function add()
    {
        $data = [
            'title' => '',
            'body' => '',
            'user_id' => $_SESSION['user_id'],
            'err' => '',
            'active' => 'home',
        ];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitize POST Array
            $_POST['title'] = filter_var($_POST['title'], FILTER_SANITIZE_STRING);
            $_POST['body'] = htmlspecialchars($_POST['body']);
            $data = [
                'title' => trim($_POST['title']),
                'body' => trim($_POST['body']),
                'user_id' => $_SESSION['user_id'],
                'err' => '',
                'active' => 'home',
            ];
            // Validate data
            if (empty($data['title'])) {
                $data['err'] = 'Title field is required</br>';
            }

            if ($data['body'] == ' ' || $data['body'] == htmlspecialchars('<p>&nbsp;</p>')) {
                $data['err'] = $data['err'] . 'Body field is required';
            }
            // Make sure no errors
            if (empty($data['err'])) {
                // Validated
                if ($this->postModel->addPost($data)) {
                    flash('post_message', 'New Post Added Successfully');
                    redirect('posts');
                } else {
                    die('Something went wrong');
                }
            } else {
                // Load view with errors
                flash('post_message', $data['err'], 'alert alert-danger');
                $this->loadView('posts/add', $data);
            }
        } else {
            $this->loadView('posts/add', $data);
        }
    }

    // Edit Post
    public function edit($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitize POST Array
            $_POST['title'] = filter_var($_POST['title'], FILTER_SANITIZE_STRING);
            $_POST['body'] = htmlspecialchars($_POST['body']);
            $data = [
                'id' => $id,
                'title' => trim($_POST['title']),
                'body' => trim($_POST['body']),
                'err' => '',
                'active' => 'home',
            ];
            // Validate data
            if (empty($data['title'])) {
                $data['err'] = 'Title field is required</br>';
            }

            if ($data['body'] == ' ' || $data['body'] == htmlspecialchars('<p>&nbsp;</p>')) {
                $data['err'] = $data['err'] . 'Body field is required';
            }
            // Make sure no errors
            if (empty($data['err'])) {
                // Validated
                if ($this->postModel->updatePost($data)) {
                    flash('edit_message', 'Post Updated Successfully');
                    redirect('posts/show/' . $id);
                } else {
                    die('Something went wrong');
                }
            } else {
                // Load view with errors
                flash('edit_err_message', $data['err'], 'alert alert-danger');
                $this->loadView('posts/edit/' . $_POST['id'], $data);
            }
        } else {
            $post = $this->postModel->getPostById($id);
            // Check for owner
            if ($post->author_id != $_SESSION['user_id']) {
                redirect('posts');
            } else {
                $data = [
                    'id' => $post->id,
                    'title' => $post->title,
                    'body' => $post->body,
                    'active' => 'home',
                ];
                $this->loadView('posts/edit', $data);
            }
        }
    }

    // Delete a post
    public function delete($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $post = $this->postModel->getPostById($id);
            // Check for owner
            if ($post->author_id != $_SESSION['user_id']) {
                echo 'hello';
                redirect('posts');
            } else {
                if ($this->postModel->deletePost($id)) {
                    echo 'hello';
                    flash('post_message', 'Post Removed');
                    redirect('posts');
                } else {
                    die('Something went wrong');
                }
            }
        } else {
            echo 'hello';
            redirect('posts');
        }
    }
}