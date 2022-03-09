<?php
class Paginator{
	var $items_per_page;
	var $items_total;
	var $current_page;
	var $num_pages;
	var $mid_range;
	var $low;
	var $high;
	var $limit;
	var $return;
	var $default_ipp;
	var $querystring;
	var $url_next;

	function Paginator()
	{
		$this->current_page = 1;
		$this->mid_range = 7;
		$this->items_per_page = $this->default_ipp;
		$this->url_next = $this->url_next;

	}
	function paginate()
	{
		global $Page;

		if(!is_numeric($this->items_per_page) OR $this->items_per_page <= 0) $this->items_per_page = $this->default_ipp;
		$this->num_pages = ceil($this->items_total/$this->items_per_page);

		if($this->current_page < 1 Or !is_numeric($this->current_page)) $this->current_page = 1;
		if($this->current_page > $this->num_pages) $this->current_page = $this->num_pages;
		$prev_page = $this->current_page-1;
		$next_page = $this->current_page+1;

		if($this->num_pages > $this->mid_range)
		{
			$this->return = ($this->current_page != 1 And $this->items_total >= $this->items_per_page) ? '<li class="paginate_button previous"><a href="'.$this->url_next.$prev_page.'">Previous</a></li>':'<li class="paginate_button previous disabled" ><a href="javascript:void(0)">Previous</a></li>';

			$this->start_range = $this->current_page - floor($this->mid_range/2);
			$this->end_range = $this->current_page + floor($this->mid_range/2);

			if($this->start_range <= 0)
			{
				$this->end_range += abs($this->start_range)+1;
				$this->start_range = 1;
			}
			if($this->end_range > $this->num_pages)
			{
				$this->start_range -= $this->end_range-$this->num_pages;
				$this->end_range = $this->num_pages;
			}
			$this->range = range($this->start_range,$this->end_range);

			for($i=1;$i<=$this->num_pages;$i++)
			{
				if($this->range[0] > 2 And $i == $this->range[0]) $this->return .= '<li class="paginate_button disabled"><a href="javascript:void(0)">...</a></li>';
				if($i==1 Or $i==$this->num_pages Or in_array($i,$this->range))
				{
					$this->return .= ($i == $this->current_page And $Page != 'All') ? '<li class="paginate_button active "><a href="javascript:void(0)">'.$i.'</a></li>':'<li class="paginate_button "><a href="'.$this->url_next.$i.'">'.$i.'</a></li>';
				}
				if($this->range[$this->mid_range-1] < $this->num_pages-1 And $i == $this->range[$this->mid_range-1]) $this->return .= '<li class="paginate_button disabled"><a href="javascript:void(0)">...</a></li>';
			}
			$this->return .= (($this->current_page != $this->num_pages And $this->items_total >= $this->items_per_page) And ($Page != 'All')) ? '<li class="paginate_button next"><a href="'.$this->url_next.$next_page.'" aria-controls="example2" >Next</a></li>':'<li class="paginate_button next disabled"><a href="javascript:void(0)">Next</a></li>';
		}
		else
		{
			$this->return = ($this->current_page != 1 And $this->items_total >= $this->items_per_page) ? '<li class="paginate_button previous"><a href="'.$this->url_next.$prev_page.'">Previous</a></li>':'<li class="paginate_button previous disabled" ><a href="javascript:void(0)">Previous</a></li>';
			for($i=1;$i<=$this->num_pages;$i++)
			{
				$this->return .= ($i == $this->current_page) ? '<li class="paginate_button active "><a href="javascript:void(0)">'.$i.'</a></li>':'<li class="paginate_button "><a href="'.$this->url_next.$i.'">'.$i.'</a></li>';
			}
						$this->return .= (($this->current_page != $this->num_pages And $this->items_total >= $this->items_per_page) And ($Page != 'All')) ? '<li class="paginate_button next"><a href="'.$this->url_next.$next_page.'" aria-controls="example2" >Next</a></li>':'<li class="paginate_button next disabled"><a href="javascript:void(0)">Next</a></li>';
		}
		$this->low = ($this->current_page-1) * $this->items_per_page;

	}
	
	function paginate2($txt_replace)
	{
		global $Page;
	

		if(!is_numeric($this->items_per_page) OR $this->items_per_page <= 0) $this->items_per_page = $this->default_ipp;
		$this->num_pages = ceil($this->items_total/$this->items_per_page);

		if($this->current_page < 1 Or !is_numeric($this->current_page)) $this->current_page = 1;
		if($this->current_page > $this->num_pages) $this->current_page = $this->num_pages;
		$prev_page = $this->current_page-1;
		$next_page = $this->current_page+1;

		if($this->num_pages > $this->mid_range)
		{
				/*$find0=array($txt_replace,'?Page=');
				if($prev_page==1){
					$replace0=array($txt_replace,'');
				}else{
					$replace0=array($txt_replace.'-'.$prev_page,'');
				}*/
			$this->return = ($this->current_page != 1 And $this->items_total >= $this->items_per_page) ? '<li class="paginate_button previous"><a href="'.$this->url_next.'">Previous</a></li>':'<li class="paginate_button previous disabled" ><a href="javascript:void(0)">Previous</a></li>';

			$this->start_range = $this->current_page - floor($this->mid_range/2);
			$this->end_range = $this->current_page + floor($this->mid_range/2);

			if($this->start_range <= 0)
			{
				$this->end_range += abs($this->start_range)+1;
				$this->start_range = 1;
			}
			if($this->end_range > $this->num_pages)
			{
				$this->start_range -= $this->end_range-$this->num_pages;
				$this->end_range = $this->num_pages;
			}
			$this->range = range($this->start_range,$this->end_range);

			for($i=1;$i<=$this->num_pages;$i++)
			{
				/*$find=array($txt_replace,'?Page=');
				if($i==1){
					$replace=array($txt_replace,'');
				}else{
					$replace=array($txt_replace.'-'.$i,'');
				}*/
				if($this->range[0] > 2 And $i == $this->range[0]) $this->return .= '<li class="paginate_button disabled"><a href="javascript:void(0)">...</a></li>';
				if($i==1 Or $i==$this->num_pages Or in_array($i,$this->range))
				{
					$this->return .= ($i == $this->current_page And $Page != 'All') ? '<li class="paginate_button active "><a href="javascript:void(0)">'.$i.'</a></li>':'<li class="paginate_button "><a href="'.$this->url_next.$next_page.'">'.$i.'</a></li>';
				}
				if($this->range[$this->mid_range-1] < $this->num_pages-1 And $i == $this->range[$this->mid_range-1]) $this->return .= '<li class="paginate_button disabled"><a href="javascript:void(0)">...</a></li>';
			}
				/*$find2=array($txt_replace,'?Page=');
				if($next_page==1){
					$replace2=array($txt_replace,'');
				}else{
					$replace2=array($txt_replace.'-'.$next_page,'');
				}*/
			$this->return .= (($this->current_page != $this->num_pages And $this->items_total >= $this->items_per_page) And ($Page != 'All')) ? '<li class="paginate_button next"><a href="'.$this->url_next.$next_page.'" aria-controls="example2" >Next</a></li>':'<li class="paginate_button next disabled"><a href="javascript:void(0)">Next</a></li>';
			
		}
		else
		{
				/*$find0=array($txt_replace,'?Page=');
				if($prev_page==1){
					$replace0=array($txt_replace,'');
				}else{
					$replace0=array($txt_replace.'-'.$prev_page,'');
				}*/
				
			$this->return = ($this->current_page != 1 And $this->items_total >= $this->items_per_page) ? '<li class="paginate_button previous"><a href="'.$this->url_next.'">Previous</a></li>':'<li class="paginate_button previous disabled" ><a href="javascript:void(0)">Previous</a></li>';

			for($i=1;$i<=$this->num_pages;$i++)
			{
			/*	$find=array($txt_replace,'?Page=');
				if($i==1){
					$replace=array($txt_replace,'');
				}else{
					$replace=array($txt_replace.'-'.$i,'');
				}*/
			
				$this->return .= ($i == $this->current_page) ? '<li class="paginate_button active "><a href="javascript:void(0)">'.$i.'</a></li>':'<li class="paginate_button "><a href="'.$this->url_next.'">'.$i.'</a></li>';
			}
			
				/*$find2=array($txt_replace,'?Page=');
				if($next_page==1){
					$replace2=array($txt_replace,'');
				}else{
					$replace2=array($txt_replace.'-'.$next_page,'');
				}*/
			
						$this->return .= (($this->current_page != $this->num_pages And $this->items_total >= $this->items_per_page) And ($Page != 'All')) ? '<li class="paginate_button next"><a href="'.$this->url_next.'" aria-controls="example2" >Next</a></li>':'<li class="paginate_button next disabled"><a href="javascript:void(0)">Next</a></li>';
		}
		$this->low = ($this->current_page-1) * $this->items_per_page;

	}

	function display_pages()
	{
		return $this->return;
	}
}
function showPagination(){
	global $Per_Page,$Page,$pages,$Num_Rows;
	?>
    <div class="row"><div class="col-sm-5"><div class="dataTables_info" id="example2_info" role="status" aria-live="polite"># <?php echo ($Page*$Per_Page)-($Per_Page)+1;?> - <?php if(($Page*$Per_Page)<$Num_Rows){echo ($Page*$Per_Page);}else{echo $Num_Rows;}?> จากทั้งหมด <?php echo $Num_Rows;?> </div></div>
    <div class="col-sm-7"><div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
    <ul class="pagination pull-right"><?php echo $pages->display_pages() ?></ul></div></div></div>	
	<?php
}
function showPagination2(){
	global $Per_Page,$Page,$pages,$Num_Rows;
	?>
    <div class="row-fluid"><div class="span5"><div class="dataTables_info" id="example2_info" role="status" aria-live="polite"># <?php echo ($Page*$Per_Page)-($Per_Page)+1;?> - <?php if(($Page*$Per_Page)<$Num_Rows){echo ($Page*$Per_Page);}else{echo $Num_Rows;}?> จากทั้งหมด <?php echo $Num_Rows;?> </div></div>
    <div class="span7">
    <?php if($Num_Rows>$Per_Page){ ?>
    <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
    <ul class="pagination pull-right"><?php echo $pages->display_pages() ?></ul></div>
    <?php } ?>
    </div></div>	
	<?php
}
?>