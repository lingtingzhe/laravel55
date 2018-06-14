<?php
/**
 * Created by PhpStorm.
 * User: huolian
 * Date: 2018/6/13
 * Time: 下午6:54
 */

namespace App\Http\Controllers\Api;

use ButterCMS\ButterCMS;

class HeadlessController
{
    protected $apiToken = '123456';

    public function index()
    {
        $butterCms = new ButterCMS($this->apiToken);

        $page = $butterCms->fetchPage('about', 'welcome-to-the-site');

// These are equivalent
        echo $page->getFields()['some-field'];
        echo $page->getField('some-field');

        $pagesResponse = $butterCms->fetchPages('news', ['breaking-news' => true]);
        var_dump($pagesResponse->getMeta()['count']);
        foreach ($pagesResponse->getPages() as $page) {
            echo $page->getSlug();
        }
// Error Handling
        try {
            $butterCms->fetchPage('about', 'non-existent-page');
        } catch (GuzzleHttp\Exception\BadResponseException $e) {
            // Happens for any non-200 response from the API
            var_dump($e->getMessage());
        } catch (\UnexpectedValueException $e) {
            // Happens if there is an issue parsing the JSON response
            var_dump($e->getMessage());
        }
    }
}