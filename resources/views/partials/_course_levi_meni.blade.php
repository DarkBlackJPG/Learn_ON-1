<div id="desnimeni">
    <div style=" width:100%; height:3em">
        <a href="#" id="cat_link" style=" font-family: Intro_Bold">LESSONS</a>
    </div>
    <div id="lessons">
        @foreach($course->lectures as $lecture)
        <div id="les_thumb" >
            <div>
                <h3 style="color:white">Picture</h3>
            </div>
        </div>
        <div id="les_content" class="inline content_class">
            <div id="les_title">
                Naslov
            </div>
            <div id="les_desc">
                Naslov
            </div>
            <div id="les_date">
                Naslov
            </div>
        </div>
        @endforeach
    </div>
</div>