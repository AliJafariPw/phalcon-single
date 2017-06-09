<?php
namespace Application\Controllers;

use Application\Models\Blog;
use Phalcon\Mvc\Controller;

/**
 * Display the default index page.
 */
class BlogController extends Controller
{

    /**
     * Index of blog
     */
    public function indexAction()
    {
        $this->view->title = "Blog";
        $this->view->blogs = Blog::find(["limit" => 10 , "order" => "id DESC"]);
    }

    /**
     * View single of blog
     */
    public function viewAction($id)
    {
        $blog = Blog::findFirst([
            "conditions" => "id = :id:",
            "bind" => [
                "id" => $id,
            ]
        ]);
        $this->view->title = $blog->title." - Blog";
        $this->view->blog = $blog;
    }
}
