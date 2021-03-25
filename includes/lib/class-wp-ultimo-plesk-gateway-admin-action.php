<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class WP_Ultimo_Plesk_Gateway_Admin_Action
{
    public function __construct()
    {
        add_action('mercator.mapping.created', [$this, 'add_domain_alias'], 20);
        add_action('mercator.mapping.updated', [$this, 'update_domain_alias'], 20);
        add_action('mercator.mapping.deleted', [$this, 'remove_domain_alias'], 20);
    }

    public function add_domain_alias($mapping)
    {
        $domain = $mapping->get_domain();
        $this->plesk_alias_query($domain, 'create');
    }

    public function update_domain_alias($mapping)
    {
        $domain = $mapping->get_domain();
        //$this->plesk_alias_query($domain, 'create');
    }

    public function remove_domain_alias($mapping)
    {
        $domain = $mapping->get_domain();
        $this->plesk_alias_query($domain, 'delete');
    }

    protected function get_option($option) {
        return get_blog_option(1, $option);
    }

    protected function plesk_alias_query($domain, $action)
    {
        if (!defined('WPUPG_USER') || !defined('WPUPG_PASSWORD')) return;

        switch ($action) {
            case 'create':
                $method = '--create';
                break;
            case 'delete':
                $method = '--delete';
                break;
            default:
                $method = '--create';
        }

        $plesk_url      = rtrim($this->get_option('wpupg_plesk_url'), '/');
        $base_domain    = $this->get_option('wpupg_parent_domain');
        $status         = $this->get_option('wpupg_domain_status');
        $sync_dns       = $this->get_option('wpupg_synchronize_dns');
        $seo_redirect   = $this->get_option('wpupg_seo_redirect');

        $auth = base64_encode(WPUPG_USER . ':' . WPUPG_PASSWORD);

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $plesk_url . '/api/v2/cli/domalias/call',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>'{
                  "params": [
                    "' . $method . '",
                    "' . $domain . '",
                    "-domain",
                    "' . $base_domain . '",
                    "-status",
                    "' . $status . '",
                    "-dns",
                    "' . $sync_dns . '",
                    "-seo-redirect",
                    "' . $seo_redirect . '"
                    ]
                }',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Basic ' . $auth,
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }

}