<?php
class Filter
{
    protected $filters = [
                "type"=> 1,
                "page_number"=> 1,
                "view_type"=> 'simple',
                "reporter_id[]"=> 0,
                "handler_id[]"=> -1,  //Кто ответственный -1:я, 0:все
                "monitor_user_id[]"=> 0,
                "note_user_id[]"=> 0,
                "priority[]"=> 0,
                "severity[]"=> 0,
                "view_state"=> 0,
                "sticky"=> 'on',
                "category_id[]"=> 0,
                "hide_status[]"=> 80,
                "status[]"=> 0,
                "resolution[]"=> 0,
                "profile_id[]"=> 0,
                "platform[]"=> 0,
                "os[]"=> 0,
                "os_build[]"=> 0,
                "relationship_type"=> -1,
                "relationship_bug"=> 0,
                "tag_string"=> '',
                "per_page"=> 100,
                "sort[]"=> 'priority',
                "dir[]"=> 'ASC',
                "match_type"=> 0,
                "highlight_changed"=> 6,
                "search"=> '',
                "filter_submit"=> 'Фильтровать'
    ];

    public function getFilters()
    {
        return $this->filters;
    }
}