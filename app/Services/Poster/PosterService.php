<?php

namespace App\Services\Poster;

use App\Models\Title;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class PosterService
{
    private Title $title;

    public function make($poster_padding_top = 100, $poster_padding_right = 100, $poster_padding_bottom = 200, $poster_padding_left = 100)
    {
        $poster_org = Image::make($this->title->poster);
        $poster_org = $poster_org->widen(900);

        $width = $poster_org->width();
        $height = $poster_org->height();

        $new_width = $width + $poster_padding_right + $poster_padding_left;
        $new_height = $height + $poster_padding_top + $poster_padding_bottom;

        $poster = Image::canvas($new_width, $new_height, '#ffffff');

        $poster->insert($poster_org, 'top-left', $poster_padding_left, $poster_padding_top);

        $color = $this->getDominantColor();
        $poster->text("#whatiwatched", $poster->width() / 2, $poster_padding_top / 2, function ($font) use ($color) {
            $font->file('assets/fonts/vazir-black.ttf');
            $font->size(55);
            $font->color($color);
            $font->align('center');
            $font->valign('center');
        });

        $rect_x0 = $poster_padding_left;
        $rect_y0 = $poster->height() - $poster_padding_bottom + 2;
        $rect_x1 = $poster->width() - $poster_padding_right - 1;
        $rect_y1 = $poster->height();

        $poster->rectangle($rect_x0, $rect_y0, $rect_x1, $rect_y1, function ($draw) use ($color) {
            $draw->background($color);
        });


        $segments_data = [];

        # IMDB rate
        $rate_value = $this->title->rate_value;
        $rate_count = $this->title->rate_count;
        $msg = sprintf("امتیاز %s /10\nاز مجموع %d رای", $rate_value, $rate_count);
        $segments_data[] = ['img' => "assets/imgs/imdb-logo.png", 'text' => $msg];

        # Years
        $year_start = $this->title->year_start;
        $year_end = $this->title->year_end;
        $msg = "محصول ";
        if ($year_end) {
            $msg .= $year_start . " تا " . $year_end;
        } else {
            $msg .= $year_start;
        }
        $segments_data[] = ['img' => "assets/imgs/calendar.png", 'text' => $msg];


        # Metacritic
        $metacritic = $this->title->reviewServices()->find(2);
        $score = $metacritic->pivot->score;
        $total = $metacritic->pivot->count;
        $msg = sprintf("امتیاز %d از %d نقد\nدر سایت Metacritic", $score, $total);
        $segments_data[] = ['img' => "assets/imgs/metacritic-logo.png", 'text' => $msg];


        # Rotten Tomatoes
        $rotten_tomatoes = $this->title->reviewServices()->find(2);
        $score = $rotten_tomatoes->pivot->score;
        $total = $rotten_tomatoes->pivot->count;
        $msg = sprintf("امتیاز %d از %d نقد\nسایت Tomatoes Rotten", $score, $total);
        $segments_data[] = ['img' => "assets/imgs/rotten-tomatoes-logo.png", 'text' => $msg];


        $segments_data_count = count($segments_data);
        $segments_data_start = $rect_x0 + 5;
        $segments_data_end = $rect_x1 - 5;
        $segments_data_total_width = $segments_data_end - $segments_data_start;
        $segments_data_x = [];
        $last_segment = $segments_data_start;
        foreach ($segments_data as $i => $item) {
            $segment = $segments_data_start + ($i * ($segments_data_total_width / $segments_data_count));

            $last_segment = $segment;

            $segments_data[$i]['x'] = intval($segment);
        }


        foreach ($segments_data as $segment) {
            $segment_img = Image::make($segment['img']);
            $segment_img->resize(46, 46);

            $segment_img_w = $segment_img->width();
            $segment_img_h = $segment_img->height();

            $segment_img_x = $segment['x'];
            $segment_img_y = $rect_y0 + 5;

            $poster->insert($segment_img, 'top-left', $segment_img_x, $segment_img_y);

            $txt_x = $segment_img_x + $segment_img_w + 10;
            $txt_y = $segment_img_y + 5;



            $font_height = 11;

            $text = $segment['text'];

            $lines = explode("\n", $text);
            $y = $txt_y;

            foreach ($lines as $line) {
                $line = FarsiGD::render($line, true, true); //Reversed text for GD
                $poster->text($line, $txt_x, $y, function ($font) {
                    $font->file('assets/fonts/vazir-medium.ttf');
                    $font->size(14);
                    $font->color('#ffffff');
                    $font->align('left');
                    $font->valign('top');
                });

                $y += $font_height * 2;
            }
        }


        return $poster;
    }

    private function getDominantColor()
    {
        $img = Image::make($this->title->poster);
        $img->resize(1, 1);
        return $img->pickColor(0, 0);
    }

    private function abbreviateNumber($num) {
        if ($num >= 0 && $num < 1000) {
            $format = floor($num);
            $suffix = '';
        }
        else if ($num >= 1000 && $num < 1000000) {
            $format = floor($num / 1000);
            $suffix = 'K+';
        }
        else if ($num >= 1000000 && $num < 1000000000) {
            $format = floor($num / 1000000);
            $suffix = 'M+';
        }
        else if ($num >= 1000000000 && $num < 1000000000000) {
            $format = floor($num / 1000000000);
            $suffix = 'B+';
        }
        else if ($num >= 1000000000000) {
            $format = floor($num / 1000000000000);
            $suffix = 'T+';
        }

        return !empty($format . $suffix) ? Str::reverse($suffix) . $format : 0;
    }

    /**
     * @param Title $title
     */
    public function setTitle(Title $title): void
    {
        $this->title = $title;
    }


}
