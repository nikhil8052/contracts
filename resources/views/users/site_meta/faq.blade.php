@extends('users_layout.master')
@section('content')

<section class="faq-sec p-130">
    @if(isset($faqs) && $faqs->isNotEmpty())
    @foreach($faqs as $faq)
    <div class="container">
        @if($faq->key === 'main_title')
        <div class="faq-head">
            <!-- <h1>Preguntas frecuentes</h1> -->
            <h1>{{$faq->value}}</h1>
        </div>
        @endif
        <div id="">
            <div class="accordion" id="faq">
                <div class="accordion-item">
                    @if($faq->key === 'faq')
                    <div class="accordion-header" id="faqhead1">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1" aria-expanded="true" aria-controls="collapseOne">
                            <!-- ¿Qué es la plataforma Documentos-Legales.mx? -->
                            <p>{{$faq->question}}</p>
                        </button>
                    </div>
                    <div id="faq1" class="accordion-collapse collapse show" aria-labelledby="faqhead1" data-bs-parent="#faq">
                        <div class="accordion-body">
                            <p></p>
                            <p>
                                <!-- Documentos-Legales.mx es una plataforma en línea que te permite generar contratos y documentos legales personalizados según tus necesidades. Después de crear los documentos, puedes descargarlos en los
                                formatos PDF y DOCX (Word) para imprimirlos, editarlos y/o enviarlos. -->
                                {!! strip_tags($faq->answer) !!}
                            </p>
                            <p></p>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endforeach
    @endif
</section>
<section class="footer_bann_wreap p-130 faqft">
    @if(isset($faqs) && $faqs->isNotEmpty())
        <div class="container">
            <div class="global_content text-center">
                @foreach($faqs as $faqq)
                    @if($faqq->key === 'second_banner_heading')
                        <h2>{{ $faqq->value }}</h2>
                    @endif
                    @if($faqq->key === 'second_banner_sub_heading')
                        <p class="bl_sec">
                            {{ $faqq->value }}
                        </p>
                    @endif
                @endforeach
               
                 <!-- This will show the button label for debugging -->
                    @php
                        $buttonLabel = '';
                        $buttonLink = '';
                    @endphp

                    @foreach($faqs as $btn)
                        @if($btn->key === 'button_label')
                            @php
                                $buttonLabel = $btn->value;
                            @endphp
                        @elseif($btn->key === 'button_link')
                            @php
                                $buttonLink = $btn->value;
                            @endphp
                        @endif
                    @endforeach

                    @if($buttonLabel && $buttonLink)
                        <div class="start_new text-center">
                            <a href="{{ $buttonLink }}" class="cta">{{ $buttonLabel }}</a>
                        </div>
                    @endif
                
                </div>
            </div>
        </div>
    @endif    
</section>



@endsection