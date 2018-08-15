<?php

class RootController extends RootThemeController
{

    protected $theme = '';

    public function __construct()
    {
        $this->themepath = __DIR__;
        $this->get_header();
    }

    public function __destruct()
    {
        $this->get_footer();
    }

    /**
     *@noAuth
     *@url GET /
     */
    public function index()
    {
        $breadcrumb = $this->breadcrumb();
        echo '<div class="content-wrapper" >
		<section class="content-header">
		<h1>
		Page Header
		<small>Optional description</small>
		</h1>
		' . $breadcrumb . '
		</section>
		<section class="content container-fluid">
		<h1>test</h1>
		</section>
		</div>
		';
    }

}
