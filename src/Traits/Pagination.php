<?php

namespace Src\Traits;

trait Pagination
{
    public $result;

    public function pagination($result)
    {
        //sample return pagination 
        return json_decode('{
                "page_number": 5,
                "page_size": 20,
                "total_record_count": 521,
                "records": [
                    {
                    "id": 1,
                    "name": "Widget #1"
                    },
                    {
                    "id": 2,
                    "name": "Widget #2"
                    },
                    {
                    "id": 3,
                    "name": "Widget #3"
                    }
                ]
        }');
    }
}

