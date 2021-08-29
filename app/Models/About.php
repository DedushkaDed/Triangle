<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Spatie\YamlFrontMatter\YamlFrontMatter;


class About extends Model
{
    public $title;
    public $subTitle;
    public $dateCreate;
    public $body;

    /**
     * @param $title
     * @param $subTitle
     * @param $dateOfCreate
     * @param $body
     */
    public function __construct($title, $subTitle, $dateCreate, $body)
    {
        $this->title = $title;
        $this->subTitle = $subTitle;
        $this->dateCreate = $dateCreate;
        $this->body = $body;
    }

    public static function getHeadersData($slug)
    {
        if (!$aInputData = resource_path("text-data/${slug}.html")) {
            ddd("Cannot find data for this page");
        }

        $oDocument = YamlFrontMatter::parseFile($aInputData);
        $aPageResult[] = new About(
            $oDocument->title,
            $oDocument->subTitle,
            $oDocument->dateCreate,
            $oDocument->body()
        );

        return $aPageResult;
    }

    public static function getInsideData($slug)
    {
        if (!$aInsidePageData = \File::files(resource_path("text-data/{$slug}-date"))) {
            ddd(__DIR__ . 'method: getInsideData error');
        }

        return collect($aInsidePageData)
            ->map(function ($oInsideDocument) {
                return YamlFrontMatter::parseFile($oInsideDocument);
            })
            //  Ниже, array_map будет проходить по значению, который был return выше
            ->map(function ($aItem) {
                return new About(
                    $aItem->title,
                    $aItem->subTitle,
                    $aItem->dateCreate,
                    $aItem->body()
                );
            });
    }
}

