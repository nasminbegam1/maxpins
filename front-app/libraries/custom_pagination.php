<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class custom_pagination {

    function getPagination($page_no, $count_property)
    {
        $pagenum 	= $page_no;
	$total_nums	= $count_property;
	$rowsperpage	= SALES_RECORD_LIMIT_SEARCH_PAGE;
	$total_pages	= ceil($total_nums/$rowsperpage);
	$first = $prev = $nav = $next = $last = $pagination_html ='';
	
	if($total_nums > RECORD_LIMIT_SEARCH_PAGE)
	{
            $pagination_html = "<div class='pagination'><ul id='paginationLinks'>";
	    $range = PAGE_NUMBER_SHOW; //NUMBER OF PAGES TO BE SHOWN BEFORE AND AFTER THE CURRENT PAGE NUMBER
            //FIRST, PREVIOUS, NEXT, AND LAST LINKS
            if($pagenum>1)
	    {
                $page = $pagenum - 1;
		$first	= '<li class="paginate_class paginateFirst" id="1"><a href="javascript:void(0);">First</a></li> ';
	    }
            if($pagenum<$total_pages)
            {
                $page = $pagenum + 1;
		$last = '<li class="paginate_class paginateLast" id="'.$total_pages.'"><a href="javascript:void(0);">Last</a></li> ';
	    }
            //PAGINATION
	    for($page=($pagenum-$range); $page<=($pagenum+$range); $page++)
            {
		if($page>=1 && $page<=$total_pages)
		{
		    if($page == $pagenum)
		    {
                        $nav .= '<li class="current"><span class="current_number">'.$page.'</span></li> ';
		    }
                    else
                    {
                        $nav .= '<li class="paginate_class" id="'.$page.'"><a href="javascript:void(0);">'.$page.'</a></li> ';
                    }
		}
            }
            $pagination_html = $pagination_html.$first . $prev . $nav . $next . $last."</ul></div>";
	}
        return $pagination_html;
    }
    
    function getPaginationRentals($page_no, $count_property)
    {
        $pagenum 	= $page_no;
	$total_nums	= $count_property;
	$rowsperpage	= SALES_RECORD_LIMIT_SEARCH_PAGE;
	$total_pages	= ceil($total_nums/$rowsperpage);
	$first = $prev = $nav = $next = $last = $pagination_html ='';
	
	if($total_nums > RECORD_LIMIT_SEARCH_PAGE)
	{
            $pagination_html = "<div class='pagination'><ul id='paginationLinks'>";
				
	    $range = PAGE_NUMBER_SHOW; //NUMBER OF PAGES TO BE SHOWN BEFORE AND AFTER THE CURRENT PAGE NUMBER
			
            //FIRST, PREVIOUS, NEXT, AND LAST LINKS
            if($pagenum>1)
	    {
                $page = $pagenum - 1;
		$first	= '<li class="paginate_class paginateFirst" id="1"><a href="javascript:void(0);">First</a></li> ';
		//$prev	= '<li class="paginate_class" id="'.$page.'"><a href="javascript:void(0);">Prev</a></li> ';
	    }
            if($pagenum<$total_pages)
            {
                $page = $pagenum + 1;
		//$next = '<li class="paginate_class" id="'.$page.'"><a href="javascript:void(0);">Next</a></li> ';
		$last = '<li class="paginate_class paginateLast" id="'.$total_pages.'"><a href="javascript:void(0);">Last</a></li> ';
	    }
			
            //PAGINATION
	    for($page=($pagenum-$range); $page<=($pagenum+$range); $page++)
            {
		if($page>=1 && $page<=$total_pages)
		{
		    if($page == $pagenum)
		    {
                        $nav .= '<li class="current"><span class="current_number">'.$page.'</span></li> ';
		    }
                    else
                    {
                        $nav .= '<li class="paginate_class" id="'.$page.'"><a href="javascript:void(0);">'.$page.'</a></li> ';
                    }
		}
            }
            $pagination_html = $pagination_html.$first . $prev . $nav . $next . $last."</ul></div>";
	}
        
        return $pagination_html;
    }
    
    function getPaginationFavourite($page_no, $count_property)
    {
        $pagenum 	= $page_no;
	$total_nums	= $count_property;
	$rowsperpage	= FAVOURITE_PER_PAGE_LIMIT;
	$total_pages	= ceil($total_nums/$rowsperpage);
	$first = $prev = $nav = $next = $last = $pagination_html ='';
	
	if($total_nums > FAVOURITE_PER_PAGE_LIMIT)
	{
	    $pagination_html = "<div class='pagination'><ul id='paginationLinks'>";
				
	    $range = PAGE_NUMBER_SHOW; //NUMBER OF PAGES TO BE SHOWN BEFORE AND AFTER THE CURRENT PAGE NUMBER
			
            //FIRST, PREVIOUS, NEXT, AND LAST LINKS
            if($pagenum>1)
	    {
                $page = $pagenum - 1;
		$first	= '<li class="paginate_class paginateFirst" id="1"><a href="javascript:void(0);">First</a></li> ';
	    }
            if($pagenum<$total_pages)
            {
                $page = $pagenum + 1;
		$last = '<li class="paginate_class paginateLast" id="'.$total_pages.'"><a href="javascript:void(0);">Last</a></li> ';
	    }
			
            //PAGINATION
	    for($page=($pagenum-$range); $page<=($pagenum+$range); $page++)
            {
		if($page>=1 && $page<=$total_pages)
		{
		    if($page == $pagenum)
		    {
                        $nav .= '<li class="current"><span class="current_number">'.$page.'</span></li> ';
		    }
                    else
                    {
                        $nav .= '<li class="paginate_class" id="'.$page.'"><a href="javascript:void(0);">'.$page.'</a></li> ';
                    }
		}
            }
            $pagination_html = $pagination_html.$first . $prev . $nav . $next . $last."</ul></div>";
	}
        
        return $pagination_html;
    }
}