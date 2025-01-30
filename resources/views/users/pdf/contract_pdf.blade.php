<!DOCTYPE html>
<html>
<head>
    <title>dom pdf</title>
</head>
<body>
     <section class="privacy-sec questions_page_main_div">
          <div class="container">
               <div class="pdf_content">
                    @foreach($document_content as $content)
                         @if($content->secure_blur_content == 1)
                              <div id="right_content_div_{{ $content->id ?? '' }}" style="text-align:{{ $content->text_align ?? '' }}; display:none;" class="r_div right-sec-div hide mb-2">
                                   @if($content->type == 'content_heading')
                                   <p style="text-align:center; font-size:18px; font-weight:400;">{!! $content->content !!}</p>
                                   @else
                                   {!! $content->content !!}
                                   @endif
                              </div>
                         @elseif($content->is_condition == 0)
                              <span style="text-align:{{ $content->text_align ?? '' }}" class="r_div">
                                   @if($content->type == 'content_heading')
                                   <p style="text-align:center; font-size:18px; font-weight:400;">{!! $content->content !!}</p>
                                   @else
                                   {!! $content->content !!}
                                   @endif
                              </span>
                         @else
                              <div id="right_content_div_{{ $content->id ?? '' }}" style="text-align:{{ $content->text_align ?? '' }}" class="r_div right-sec-div mb-2">
                                   @if($content->type == 'content_heading')
                                   <p style="text-align:center; font-size:18px; font-weight:400;">{!! $content->content !!}</p>
                                   @else
                                   {!! $content->content !!}
                                   @endif
                              </div>
                         @endif
                    @endforeach
               </div>
          </div>
     </section>
     
</body>
</html>