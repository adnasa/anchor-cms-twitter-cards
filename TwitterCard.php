<?php

/**
 * @author Adnan Asani <konjuku@gmail.com>
 */

class TwitterCard extends Plugin
{
    /**
     * @return array
     */
    public function register_routes()
    {
        return array(
            'GET' => array(
                'admin/twitter-card-settings' => array($this, 'twitter_card_settings'),
            ),
            'POST' => array(
                'admin/twitter-card-settings' => array($this, 'twitter_card_settings_submit'),
            ),
        );
    }

    /**
     * @return TwitterCardView
     */
    public function twitter_card_settings()
    {
        $token = Csrf::token();
        $vars = array(
            'token' => $token,
            'messages' => null,
            'twitter_card_creator_username' => null,
            'twitter_card_site_username' => null,
            'twitter_card_description' => null,
        );

        if (Config::meta('twitter_card_creator_username')) {
            $vars['twitter_card_creator_username'] = Config::meta('twitter_card_creator_username');
        }

        if (Config::meta('twitter_card_site_username')) {
            $vars['twitter_card_site_username'] = Config::meta('twitter_card_site_username');
        }

        if (Config::meta('twitter_card_description')) {
            $vars['twitter_card_description'] = Config::meta('twitter_card_description');
        }

        $view = TwitterCardAdminView::create('settings', $vars)
        ->partial('header', 'partials/header', array(), false)
        ->partial('footer', 'partials/footer', array(), false);
        return $view;
    }

    public function twitter_card_settings_submit()
    {
        $input = Input::get();
        if (null !== $input['token']) {
            unset($input['token']);
            foreach ($input as $key => $value) {
                $q = Query::table('meta');
                // @TODO: check if key exists first.
                $q->where('key','=', $key)->update(array('value' => $value));
            }
        }
        return Response::redirect('admin/twitter-card-settings');

    }
}
