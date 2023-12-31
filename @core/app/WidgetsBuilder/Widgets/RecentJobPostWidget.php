<?php


namespace App\WidgetsBuilder\Widgets;

use App\Blog;
use App\BlogLang;
use App\Helpers\LanguageHelper;
use App\Jobs;
use App\Language;
use App\Menu;
use App\PageBuilder\Fields\Number;
use App\PageBuilder\Fields\Text;
use App\WidgetsBuilder\WidgetBase;
use Illuminate\Support\Str;

class RecentJobPostWidget extends WidgetBase
{

    /**
     * @inheritDoc
     */
    public function admin_render()
    {
        // TODO: Implement admin_render() method.
        $output = $this->admin_form_before();
        $output .= $this->admin_form_start();
        $output .= $this->default_fields();
        $widget_saved_values = $this->get_settings();

        $output .= $this->admin_language_tab(); //have to start language tab from here on
        $output .= $this->admin_language_tab_start();

        $all_languages = LanguageHelper::all_languages();
        foreach ($all_languages as $key => $lang) {
            $output .= $this->admin_language_tab_content_start([
                'class' => $key == 0 ? 'tab-pane fade show active' : 'tab-pane fade',
                'id' => "nav-home-" . $lang->slug
            ]);
            $output .= Text::get([
                'name' => 'widget_title_'.$lang->slug,
                'label' => __('Widget Title'),
                'value' => $widget_saved_values['widget_title_' . $lang->slug] ?? null,
            ]);
            $output .= $this->admin_language_tab_content_end();
        }

        $output .= $this->admin_language_tab_end(); //have to end language tab
        $output .= Number::get([
            'name' => 'post_items',
            'label' => __('Post Items'),
            'value' => $widget_saved_values['post_items'] ?? null,
        ]);

        $output .= $this->admin_form_submit_button();
        $output .= $this->admin_form_end();
        $output .= $this->admin_form_after();

        return $output;
    }

    /**
     * @inheritDoc
     */
    public function frontend_render()
    {
        //Implement frontend_render() method.
        $widget_saved_values = $this->get_settings();

        $widget_title = $widget_saved_values['widget_title_'.LanguageHelper::user_lang_slug()] ?? '';
        $post_items = $widget_saved_values['post_items'] ?? '';

        $blog_posts = Jobs::where(['status' => 'publish','lang' => LanguageHelper::user_lang_slug()])->get();
        if (!empty($post_items)){
            $blog_posts = $blog_posts->take($post_items);
        }
        $output = $this->widget_before(); //render widget before content
        if (!empty($widget_title)) {
            $output .= '<h4 class="widget-title style-01">' . purify_html($widget_title) . '</h4>';
        }
        $output .= '<ul class="recent_post_item">';

        foreach ($blog_posts as $post) {
            $output .= '<li class="single-recent-post-item">
                    <div class="content">
                        <h4 class="title"><a href="' . route('frontend.jobs.single',['slug' => $post->slug ]) . '">' . purify_html($post->title) . '</a></h4>
                        <span class="time"> <strong>'.__("Position").'</strong> : ' . $post->position . '</span><br>
                        <span class="time">  <strong>'.__("Deadline").'</strong> : ' .date('d M Y',strtotime($post->deadline)) . '</span>
                    </div>
                </li>';
        }
        $output .= '</ul>';

        $output .= $this->widget_after(); // render widget after content
        return $output;
    }

    /**
     * @inheritDoc
     */
    public function widget_title()
    {
        return __('Recent Job Post');
    }
}