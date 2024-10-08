@extends('users_layout.master')
@section('content')

<section class=" dark other_bg">

</section>

<!---------------------------------------------------- section2 start ------------------------------------ -->

<section class="outer_sec2  p_120">
    <div class="inner_sec2 light">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 ">
                    <div class="pdf_in1">
                        {{-- <img src="img/pdf1.png" alt=""> --}}
                        <img src="{{ asset('storage') }}/{{ $document->document_image }}" alt="">
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="pdf_in2">
                        <div class="pdf_head">
                            <h2>{{ $document->title ?? 'Acuerdo Unilateral de Confidencialidad' }} <span class="share_sn"><a href=""> <img
                                            src="img/share_icon.png" alt=""> </a></span> </h2>
                        </div>
                        <div class="ul_st">
                            <ul class="inside_ul_pdf">
                                <li><img src="img/org_tick.png" alt=""></li>
                                <li>{{ $document->valid_in ?? 'Válido en todo México' }}</li>
                            </ul>
                        </div>
                        <ul class="cont_ul">
                            <li class="drop_cont_li">
                                <div class="select">
                                    <div class="selectBtn" data-type="firstOption">
                                        5.0 <span class="span_img"> <img src="img/stars.png" alt=""> </span>
                                    </div>
                                    <div class="selectDropdown">
                                        <div class="option" data-type="fourthOption">
                                            4.5 <span class="span_img"><img src="img/stars.png" alt=""></span>
                                        </div>               
                                        <div class="option" data-type="fifthOption">
                                            3.0 <span class="span_img"><img src="img/stars.png" alt=""></span>
                                        </div>
                                        <div class="option" data-type="fifthOption">
                                            2.0 <span class="span_img"><img src="img/stars.png" alt=""></span>
                                        </div>
                                        <div class="option" data-type="fifthOption">
                                            1.0 <span class="span_img"><img src="img/stars.png" alt=""></span>
                                        </div>
                                    </div>
                                </div>
                                
                                

                            </li>
                            <li class="cont_li ">81 opiniones</li>
                        </ul>

                        <div class="cont_content">
                            {!! $document->short_description ?? '<p class="text_contr">
                                El Acuerdo Unilateral de Confidencialidad es de gran importancia cuando se trata de
                                proteger información confidencial entre dos personas físicas o morales. En este
                                acuerdo, la parte que recibe la información se compromete a no divulgarla,
                                asegurando así su confidencialidad.

                            </p>
                            <p class="text_contr">
                                <span class="span1"> En tan solo unos minutos, crea un Acuerdo Unilateral de
                                    Confidencialidad</span>
                                ajustado a tus necesidades y en total cumplimiento con las leyes y regulaciones
                                vigentes en México. Descárgalo al instante en PDF y DOCX (Word).
                            </p>' !!}
                        </div>
                        <div class="time_box">
                            <ul class="time_ul">
                                <li class="time_li"> <span class=" span1">Última revision: </span>{{ $document->created_at->format('d/m/Y') ?? '05/2024' }} </li>
                            </ul>
                            <ul class="time_ul">
                                <li class="time_li"> <span class=" span1">Formatos: </span> @if($document->format !== null && !empty(json_decode($document->format,true))) @foreach(json_decode($document->format) as $format) {{ $format }} @endforeach @endif</li>
                            </ul>
                            <ul class="time_ul">
                                <li class="time_li"> <span class=" span1">Descargas: </span>1,587 </li>
                            </ul>
                            <!-- <ul class="time_ul">
                                <li class="time_li"> <span class=" span1">Share: </span>
                                    <div class="socal_ic">
                                        <div class="icon_soc">
                                            <a href=""><i class="fa-brands fa-facebook-f"></i></a>
                                        </div>
                                        <div class="icon_soc">
                                            <a href=""><i class="fa-brands fa-pinterest-p"></i></a>
                                        </div>
                                        <div class="icon_soc">
                                            <a href=""><i class="fa-brands fa-twitter"></i></a>
                                        </div>
                                    </div>
                                </li>
                            </ul> -->

                            <div class="con_btn_div">
                                <a href="" class="cta_light_cont ">{{ $document->btn_text ?? 'Crea tu Acuerdo ahora'}}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>


<!---------------------------------------------------- section4 start ---------------------------------- -->

<section class="sec4_conrt_ot  light size18 ">
    <div class="in_sec4_cont">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="sec4_conrt_h_ot">
                        {!! $document->long_description ?? null !!}
                        {{-- <div class="sec4_conrt_h">
                            <h2>Obtén tu Acuerdo Unilateral de Confidencialidad al instante</h2>
                        </div>
                        <p class="sec4_cont_para">
                            Recibe tu Acuerdo Unilateral de Confidencialidad inmediatamente, adaptado a la
                            legislación vigente, para asegurar una gestión efectiva y segura de la información
                            confidencial en México. Nuestro servicio garantiza un equilibrio perfecto entre
                            cumplimiento legal y protección de datos, ofreciéndote tranquilidad y control sobre la
                            información sensible de tu empresa, negocio o proyecto. Te proporcionamos un acuerdo
                            ideal, diseñado para adaptarse a las particularidades de cada situación, y promover una
                            gestión transparente y segura de tus datos confidenciales.
                        </p> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="in_sec4_card_box p_120 pt-0">
        <div class="container">
            <div class="row">
                @if(isset($document->documentAgreement))
                    @foreach($document->documentAgreement as $agreement)
                        <div class="col-lg-3 col-md-6  mb-2">
                            <div class="card_sec4_conrt ">
                                <div class="img_sec4">
                                    <img src="{{ asset('storage') }}/{{ $agreement->media->file_name ?? '' }}" alt="">
                                </div>
                                <div class="sec4_card_p">
                                    <h6 class="size20">{{ $agreement->heading ?? 'Creación rápida y sencilla' }}</h6>
                                    <p class="sec4_card_para">
                                        {{ $agreement->description ?? 'Elabora tu Acuerdo Unilateral de Confidencialidad de forma rápida y directa.
                                        Nuestra plataforma es fácil de usar y está optimizada para ahorrar tiempo y
                                        esfuerzo, permitiéndote enfocarte en lo que realmente importa. Simplificamos el
                                        proceso legal para que puedas obtener un documento vital sin complicaciones.'}}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
                {{-- <div class="col-lg-3 col-md-6 mb-2">
                    <div class="card_sec4_conrt">
                        <div class="img_sec4">
                            <img src="img/sec4_conrt_img2.png" alt="">
                        </div>
                        <div class="sec4_card_p">
                            <h6 class="size20">Seguridad jurídica</h6>
                            <p class="sec4_card_para">
                                Nuestro Acuerdo Unilateral de Confidencialidad está actualizado con las normas
                                vigentes en México, proporcionándote la seguridad de que estás completamente
                                protegido bajo la ley. Cada cláusula del documento ha sido meticulosamente revisada
                                para garantizar su validez legal, dándote una base sólida y confiable.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6  mb-2">
                    <div class="card_sec4_conrt">
                        <div class="img_sec4">
                            <img src="img/sec4_conrt_img3.png" alt="">
                        </div>
                        <div class="sec4_card_p">
                            <h6 class="size20">Adaptabilidad a tus necesidades</h6>
                            <p class="sec4_card_para">
                                Sabemos que cada requerimiento es diferente. Te ofrecemos la opción de personalizar
                                el Acuerdo Unilateral de Confidencialidad para que se ajuste específicamente a tus
                                necesidades. Esta personalización cubre todos los aspectos del acuerdo, asegurando
                                que se adapte perfectamente a tu situación particular.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6  mb-2">
                    <div class="card_sec4_conrt">
                        <div class="img_sec4">
                            <img src="img/sec4_conrt_img4.png" alt="">
                        </div>
                        <div class="sec4_card_p">
                            <h6 class="size20">Descarga inmediata en PDF y DOCX (Word)</h6>
                            <p class="sec4_card_para">
                                Recibe tu Acuerdo Unilateral de Confidencialidad en formatos PDF y DOCX (Word) justo
                                después de su creación, dándote la libertad de elegir el formato que mejor se adapte
                                a tus necesidades. Esta flexibilidad te permite no solo seleccionar el formato
                                preferido, sino también manejar la presentación y almacenamiento del documento según
                                tus preferencias personales.
                            </p>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>


</section>



<!---------------------------------------------------- section5 start------------------------------------>
<section class="sec5_conrt_ot dark p_120 pt-0">
    <div class="in_cont_sec5bg p_120">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7">
                    <div class="ot_sec5_cont">
                        <div class="head_cont">
                            <h3>
                                {{ $document->legal_heading ?? 'Recibe tu Acuerdo Unilateral de Confidencialidad de inmediato' }}
                            </h3>
                            <p>
                                {{ $document->legal_description ?? "Protege información delicada con tu Acuerdo de Confidencialidad personalizado,
                                totalmente conforme a las leyes y regulaciones mexicanas. Descarga los formatos PDF
                                y DOCX (Word) de manera rápida y sencilla para asegurar tus acuerdos con total
                                confianza."}}
                            </p>

                            <div class="sec5_cont_btn">
                                <a href="{{ $document->legal_btn_link ?? null }}" class="cta_org padd-cta">{{ $document->legal_btn_text ??  'Crear Acuerdo de Confidencialidad' }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="cont_sec5_img">
                        <img src="{{ asset('storage') }}/{{ $document->legal_doc_image ?? '' }}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>


<!---------------------------------------------------- section6 start------------------------------------>


<section class="sec6_outer_para light">
    <div class="inside_para_sec6">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="Para_ot_box">
                        <div class="head_sec6_para">
                            <h3>
                                Para qué se utiliza un Acuerdo Unilateral de <br> Confidencialidad?
                            </h3>
                            <p>En el ámbito empresarial y legal, el Acuerdo Unilateral de Confidencialidad emerge
                                como una herramienta para establecer un marco de protección y privacidad en la
                                información compartida. A través de este instrumento, una de las partes involucradas
                                formaliza su compromiso de mantener en secreto y resguardar datos sensibles,
                                evitando su revelación no autorizada. En este artículo, exploraremos en profundidad
                                los diversos usos, aplicaciones y los valiosos beneficios que aporta este acuerdo en
                                una variedad de situaciones.</p>
                        </div>
                        <div class="para_h_const">
                            <h6 class="creac">Creación rápida y sencilla</h6>
                            <p class="h_const_p">
                                Elabora tu Acuerdo Unilateral de Confidencialidad de forma rápida y directa. Nuestra
                                plataforma es fácil de usar y está optimizada para ahorrar tiempo y esfuerzo,
                                permitiéndote enfocarte en lo que realmente importa. Simplificamos el proceso legal
                                para que puedas obtener un documento vital sin complicaciones.
                            </p>
                        </div>
                        <div class="para_h_const">
                            <h6 class="creac">Innovación y desarrollo de productos</h6>
                            <p class="h_const_p">
                                En la industria de la innovación y desarrollo de productos, el intercambio de ideas
                                y conceptos es crucial. Este acuerdo se convierte en un recurso clave para
                                salvaguardar la propiedad intelectual y mantener la privacidad de diseños, planes y
                                prototipos. Esto permite a las partes explorar nuevas posibilidades sin el riesgo de
                                que la información se divulgue de manera indebida.
                            </p>
                        </div>
                        <div class="img_sec6_box">
                            <img class="sec6_inner_img" src="img/sec6_img1.png" alt="">
                        </div>
                        <div class="para_h_const">
                            <h6 class="creac">Negociaciones y acuerdos comerciales</h6>
                            <p class="h_const_p">
                                Durante las negociaciones y la formalización de acuerdos comerciales, es común
                                compartir detalles estratégicos, financieros y comerciales. El Acuerdo Unilateral de
                                Confidencialidad actúa como un escudo protector para resguardar la información
                                durante estas etapas críticas. Esto asegura que las partes puedan intercambiar
                                información relevante sin preocuparse por su divulgación.G
                            </p>
                        </div>
                        <div class="para_h_const">
                            <h6 class="creac">Investigación y desarrollo</h6>
                            <p class="h_const_p">
                                En el ámbito de la investigación científica y tecnológica, la colaboración puede
                                conducir a avances significativos. Este acuerdo es esencial cuando las partes
                                comparten resultados experimentales, datos técnicos o ideas innovadoras. Al
                                formalizar la confidencialidad de esta información, se fomenta la cooperación entre
                                investigadores y científicos.
                            </p>
                        </div>
                        <div class="para_h_const">
                            <h6 class="creac">Protección de propiedad intelectual</h6>
                            <p class="h_const_p">
                                Para las empresas creativas, proteger la propiedad intelectual es esencial. El
                                acuerdo asegura que los detalles sobre invenciones, diseños y creaciones artísticas
                                se mantengan en secreto durante el proceso de colaboración. Esto garantiza que los
                                derechos de propiedad intelectual estén preservados.
                            </p>
                        </div>
                    </div>


                    <!----------------------- next_box ----------------------------------- -->

                    <div class="next_sec6_box">
                        <div class="Para_ot_box">
                            <div class="head_sec6_para">
                                <h3>
                                    ¿Qué incluir en un Acuerdo Unilateral de <br> Confidencialidad?
                                </h3>
                            </div>
                            <div class="para_h_const">
                                <h6 class="creac">Identificación y detalles de las partes</h6>
                                <p class="h_const_p">
                                    El acuerdo comienza por identificar de manera clara a las partes involucradas en
                                    la transacción. Esto implica proporcionar los nombres legales, direcciones,
                                    datos de contacto y cualquier información relevante que permita una
                                    identificación precisa de las partes.
                                </p>
                            </div>
                            <div class="para_h_const">
                                <h6 class="creac">Definición de información confidencial</h6>
                                <p class="h_const_p">
                                    Uno de los pilares fundamentales del acuerdo es la definición exhaustiva de qué
                                    se considerará información confidencial. Esto puede abarcar desde datos
                                    financieros hasta estrategias comerciales, propiedad intelectual, secretos
                                    industriales y cualquier otro tipo de información acordada para ser compartida.
                                </p>
                            </div>
                            <div class="img_sec6_box">
                                <img class="sec6_inner_img" src="img/sec6_img2.png" alt="">
                            </div>
                            <div class="para_h_const">
                                <h6 class="creac">Propósito del Intercambio de Información</h6>
                                <p class="h_const_p">
                                    El acuerdo debe establecer con claridad el propósito y la finalidad detrás del
                                    intercambio de información confidencial. Puede tratarse de colaboración en
                                    proyectos, evaluación de oportunidades de negocio o cualquier otro motivo
                                    específico que motive la divulgación.
                                </p>
                            </div>
                            <div class="para_h_const">
                                <h6 class="creac">Obligación de confidencialidad</h6>
                                <p class="h_const_p">
                                    Una de las cláusulas más cruciales del acuerdo es la obligación de mantener la
                                    confidencialidad. Esta cláusula establece que ambas partes se comprometen a no
                                    divulgar la información confidencial compartida durante la vigencia del acuerdo.
                                    También puede detallar cómo se debe tratar y proteger la información
                                    confidencial, incluyendo medidas de seguridad.
                                </p>
                            </div>
                            <div class="para_h_const">
                                <h6 class="creac">Restricciones y limitaciones</h6>
                                <p class="h_const_p">
                                    El acuerdo puede establecer restricciones y limitaciones en cuanto al uso de la
                                    información confidencial. Puede definir quiénes dentro de las organizaciones
                                    pueden acceder a la información y bajo qué circunstancias se puede compartir con
                                    terceros.
                                </p>
                            </div>
                            <div class="para_h_const">
                                <h6 class="creac">Duración del acuerdo</h6>
                                <p class="h_const_p">
                                    La duración del acuerdo es otro aspecto fundamental. Puede establecerse por un
                                    período específico o hasta que se cumplan ciertas condiciones. Esta cláusula
                                    garantiza que ambas partes comprendan cuánto tiempo se comprometen a mantener la
                                    confidencialidad
                                </p>
                            </div>
                            <div class="para_h_const">
                                <h6 class="creac">Consecuencias por incumplimiento</h6>
                                <p class="h_const_p">
                                    El acuerdo debe establecer las consecuencias en caso de que una de las partes no
                                    cumpla con sus obligaciones de confidencialidad. Esto puede incluir sanciones
                                    económicas o acciones legales para remediar el daño causado por la divulgación
                                    no autorizada.
                                </p>
                            </div>
                            <div class="para_h_const">
                                <h6 class="creac">Jurisdicción y ley aplicable</h6>
                                <p class="h_const_p">
                                    Una cláusula de jurisdicción y ley aplicable define qué leyes regirán el acuerdo
                                    y dónde se resolverán las disputas en caso de incumplimiento o conflicto. Esto
                                    proporciona una guía para resolver controversias de manera eficiente y brinda
                                    certeza.
                                </p>
                            </div>
                            <div class="para_h_const">
                                <h6 class="creac">Terminación del acuerdo</h6>
                                <p class="h_const_p">
                                    El acuerdo debe establecer cuándo y cómo puede ser terminado. Esto puede ser por
                                    mutuo acuerdo, cuando se cumpla con el propósito acordado o bajo ciertas
                                    condiciones específicas.
                                </p>
                            </div>
                            <div class="para_h_const">
                                <h6 class="creac">Acciones en caso de requerimientos Legales</h6>
                                <p class="h_const_p">
                                    En situaciones en las que una autoridad legal requiere la divulgación de
                                    información confidencial, el acuerdo puede especificar cómo deben actuar las
                                    partes. Puede requerir notificar a la otra parte y tomar medidas legales para
                                    proteger la información confidencial.
                                </p>
                                <p class="h_const_p">
                                    En resumen, el Acuerdo Unilateral de Confidencialidad es un recurso poderoso
                                    para proteger información valiosa y sensible en diversas circunstancias. Su
                                    estructura y cláusulas se diseñan para garantizar la confidencialidad,
                                    establecer obligaciones claras y brindar protección legal a ambas partes que
                                    participan en el intercambio de información.
                                </p>
                                <p class="h_const_p">
                                    Para crear un acuerdo de confidencialidad adaptado a tus necesidades, te
                                    recomendamos utilizar nuestro generador de contratos, asegurando que tu
                                    información esté protegida y respaldada por las leyes y regulaciones vigentes en
                                    México.
                                </p>
                            </div>
                        </div>
                    </div>

                    
                    <!------------------------------- next_box ---------------------------------- -->

                    <div class="next_sec6_box">
                        <div class="Para_ot_box">
                            <div class="head_sec6_para">
                                <h3>
                                    Ventajas para el receptor de utilizar un Acuerdo Unilateral de Confidencialidad
                                </h3>
                                <p>Para el receptor, un Acuerdo Unilateral de Confidencialidad no solo sirve como una herramienta para la protección de la información, sino que también fortalece la confianza en las relaciones comerciales y salvaguarda los intereses estratégicos. Estas ventajas son fundamentales para garantizar una colaboración efectiva y preservar la ventaja competitiva.</p>
                            </div>
                            <div class="para_h_const">
                                <h6 class="creac">Protección de información sensible</h6>
                                <p class="h_const_p">
                                    Este tipo de acuerdo establece claramente las condiciones bajo las cuales la información confidencial puede ser compartida y utilizada, reduciendo significativamente el riesgo de divulgación no autorizada. Para el receptor, esto se traduce en una mayor protección de la información que, si se revelara, podría comprometer sus intereses o ventaja competitiva. La definición precisa de qué constituye información confidencial ayuda a prevenir malentendidos y posibles litigios.
                                </p>
                            </div>
                            <div class="para_h_const">
                                <h6 class="creac">Fortalecimiento de la confianza</h6>
                                <p class="h_const_p">
                                    Al aceptar un Acuerdo Unilateral de Confidencialidad, el receptor muestra su compromiso con la protección de la información, lo que puede fortalecer la confianza de la parte divulgadora. Esta confianza es esencial para establecer y mantener relaciones comerciales sólidas y duraderas, y puede facilitar un mayor intercambio de información y cooperación.
                                </p>
                            </div>
                            <div class="img_sec6_box">
                                <img class="sec6_inner_img" src="img/sec6_img3.png" alt="">
                            </div>


                            <div class="para_h_const">
                                <h6 class="creac">Prevención de conflictos</h6>
                                <p class="h_const_p">
                                    El acuerdo proporciona un marco legal claro que define las responsabilidades del receptor respecto a la información confidencial. Esto ayuda a prevenir disputas al establecer límites claros y consecuencias definidas por el incumplimiento, lo que a su vez, asegura una relación más armoniosa y productiva entre las partes.
                                </p>
                               
                            </div>
                            <div class="para_h_const">
                                <h6 class="creac">Respaldo legal en casos de disputa</h6>
                                <p class="h_const_p">
                                    En caso de que se produzca una fuga de información o un incumplimiento del acuerdo, el receptor tiene un marco legal sobre el cual apoyarse para defender su posición o tomar acciones correctivas. Esto proporciona una base sólida para la protección de sus derechos y la toma de medidas legales si fuera necesario.
                                </p>
                               
                            </div>
                            <div class="para_h_const">
                                <h6 class="creac">Mantenimiento de la ventaja competitiva</h6>
                                <p class="h_const_p">
                                    Al garantizar que la información confidencial no se divulgue ni se utilice indebidamente, el receptor puede mantener su ventaja competitiva en el mercado. La protección de los secretos comerciales y la información estratégica es crucial para la innovación y el éxito a largo plazo en un entorno empresarial competitivo.\
                                </p>
                                <p class="h_const_p">
                                    Utilizar un Acuerdo Unilateral de Confidencialidad permite al receptor enfocarse en el desarrollo de sus actividades y proyectos sin el temor de que la información vital sea comprometida, facilitando así un entorno de trabajo más seguro y propicio para el crecimiento y la innovación.
                                </p>
                               
                            </div>
                            <div class="para_h_const">
                                <h6 class="creac">Prevención de conflictos</h6>
                                <p class="h_const_p">
                                    El acuerdo proporciona un marco legal claro que define las responsabilidades del receptor respecto a la información confidencial. Esto ayuda a prevenir disputas al establecer límites claros y consecuencias definidas por el incumplimiento, lo que a su vez, asegura una relación más armoniosa y productiva entre las partes.
                                </p>
                               
                            </div>
                        </div>
                    </div>

                      <!------------------------------- next_box ---------------------------------- -->

                    <div class="next_sec6_box">
                        <div class="Para_ot_box">
                            <div class="head_sec6_para">
                                <h3>
                                    Ventajas para el divulgante de utilizar un Acuerdo Unilateral de Confidencialidad
                                </h3>
                                <p>Un Acuerdo Unilateral de Confidencialidad ofrece al divulgante una serie de beneficios esenciales para proteger su información, asegurando que la divulgación se maneje con la máxima seguridad y privacidad.</p>
                            </div>
                            <div class="para_h_const">
                                <h6 class="creac">Control sobre la información compartida</h6>
                                <p class="h_const_p">
                                    Este tipo de acuerdo permite al divulgante especificar claramente qué información se considera confidencial y cuáles son los límites para su uso y divulgación. Al delinear específicamente los detalles de la información confidencial, el divulgante puede prevenir malentendidos o usos indebidos, asegurando que solo se comparta lo que se ha acordado expresamente.
                                </p>
                            </div>
                            <div class="para_h_const">
                                <h6 class="creac">Salvaguarda legal ante divulgaciones no autorizadas</h6>
                                <p class="h_const_p">
                                    Al establecer un marco legal claro, el acuerdo protege al divulgante contra posibles divulgaciones no autorizadas o mal uso de la información. En caso de incumplimiento, el divulgante tiene una base sólida para emprender acciones legales, lo cual sirve como un fuerte disuasivo contra la violación del acuerdo.
                                </p>
                            </div>
                            <div class="para_h_const">
                                <h6 class="creac">Confianza en las negociaciones</h6>
                                <p class="h_const_p">
                                    El Acuerdo Unilateral de Confidencialidad fomenta un entorno de confianza durante las negociaciones, permitiendo que el divulgante comparta información valiosa sin temor a que esta se filtre o se utilice en su contra. Esto es crucial en etapas tempranas de diálogo o colaboración, donde la confidencialidad es vital para la integridad y el éxito de las negociaciones.
                                </p>
                            </div>
                            <div class="img_sec6_box">
                                <img class="sec6_inner_img" src="img/sec6_img4.png" alt="">
                            </div>


                            <div class="para_h_const">
                                <h6 class="creac">Fundamento para relaciones comerciales a largo plazo</h6>
                                <p class="h_const_p">
                                    Al establecer términos de confidencialidad claros desde el inicio, el acuerdo sienta las bases para relaciones comerciales duraderas y respetuosas. El divulgante puede sentirse más seguro al entablar colaboraciones o alianzas, sabiendo que su información está protegida y que hay medidas claras en caso de cualquier disputa o desacuerdo.
                                </p>
                                <p class="h_const_p">
                                    Estas ventajas resaltan la importancia de un Acuerdo Unilateral de Confidencialidad para el divulgante, garantizando la protección de su información y proporcionando un marco seguro para la comunicación y colaboración con terceros.
                                </p>
                               
                            </div>
                            
                        </div>
                    </div>

                    <!------------------------------- next_box ---------------------------------- -->

                    <div class="next_sec6_box">
                        <div class="Para_ot_box">
                            <div class="head_sec6_para">
                                <h3>
                                    Normativas y Derechos Aplicables en los Acuerdos Unilaterales de Confidencialidad en México 
                                </h3>
                                <p>La suscripción de un Acuerdo Unilateral de Confidencialidad en el ámbito legal mexicano conlleva garantías y derechos que aseguran la protección y privacidad de la información compartida entre las partes involucradas. En México, existe una serie de leyes federales y regulaciones locales que sientan las bases para garantizar la validez y el cumplimiento de estos acuerdos, protegiendo los intereses y expectativas de ambas partes. En este contexto, exploraremos a fondo las regulaciones legales y los derechos inherentes a un Acuerdo Unilateral de Confidencialidad en el contexto mexicano.</p>
                            </div>
                            <div class="para_h_const">
                                <h6 class="creac">Código Civil Federal</h6>
                                <p class="h_const_p">
                                    El Código Civil Federal desempeña un rol esencial en la regulación de los contratos de confidencialidad en México. Estos estatutos abarcan aspectos críticos como la validez del acuerdo (Artículo 2735), las condiciones de no divulgación (Artículo 2737), y la delimitación de la duración del contrato (Artículo 2740). Además, el código establece las responsabilidades y compromisos de ambas partes en el contexto del intercambio de información confidencial (Artículos 2744 y 2749), asegurando así una ejecución justa y equitativa del contrato.
                                </p>
                            </div>
                            <div class="para_h_const">
                                <h6 class="creac">Ley Federal de Protección de Datos Personales en Posesión de Particulares</h6>
                                <p class="h_const_p">
                                    Acuerdo Unilateral de Confidencialidad involucra datos personales, entra en juego la Ley Federal de Protección de Datos Personales en Posesión de Particulares. Esta ley garantiza los derechos de los titulares de datos (Artículo 6), establece los principios de tratamiento y seguridad de los datos (Artículo 13), y establece la obligación de obtener el consentimiento para el manejo de datos personales (Artículo 16).
                                </p>
                            </div>
                            
                            <div class="img_sec6_box">
                                <img class="sec6_inner_img" src="img/sec6_img5.png" alt="">
                            </div>


                            <div class="para_h_const">
                                <h6 class="creac">Ley Federal del Trabajo</h6>
                                <p class="h_const_p">
                                    En el ámbito laboral, la Ley Federal del Trabajo también tiene un impacto significativo en los Acuerdos Unilaterales de Confidencialidad. Esta ley protege los derechos de los trabajadores en lo que respecta a la confidencialidad de la información a la que acceden en su entorno laboral (Artículo 133), así como la responsabilidad del empleador en la preservación de la privacidad y seguridad de los datos de los empleados (Artículo 20).
                                </p> 
                            </div>
                            
                            <div class="para_h_const">
                                <h6 class="creac">Ley de la Propiedad Industrial</h6>
                                <p class="h_const_p">
                                    Cuando un Acuerdo Unilateral de Confidencialidad trata con información relacionada con derechos de propiedad industrial, la Ley de la Propiedad Industrial entra en juego. Esta ley protege los derechos de los propietarios de marcas, patentes y diseños industriales (Artículo 2), y regula las medidas de confidencialidad en relación con el proceso de registro y protección de estos derechos (Artículo 89).
                                </p> 
                            </div>
                            <div class="para_h_const">
                                <h6 class="creac">Código Penal Federal</h6>
                                <p class="h_const_p">
                                    En casos de incumplimiento de un Acuerdo Unilateral de Confidencialidad, el Código Penal Federal contempla sanciones y penalidades para aquellos que divulguen información confidencial sin autorización. Estas sanciones pueden variar según la gravedad de la infracción, incluyendo multas y penas privativas de libertad (Artículos 210 y 213), resaltando así la seriedad con la que se trata la confidencialidad de la información.
                                </p> 
                            </div>
                            <div class="para_h_const">
                                <h6 class="creac">Legislación sobre propiedad intelectual </h6>
                                <p class="h_const_p">
                                    En el contexto de los Acuerdos Unilaterales de Confidencialidad, la legislación sobre propiedad intelectual también desempeña un rol crucial, especialmente cuando la información confidencial involucra creaciones artísticas, literarias, científicas o tecnológicas. Esta legislación ampara los derechos de los creadores y regula la protección de obras originales, como textos, imágenes, música y software, estableciendo condiciones para el uso legítimo y resguardando la confidencialidad de estas creaciones.
                                </p> 
                            </div>

                           
                            <div class="para_h_const">
                                <h6 class="creac">Ley Federal de Competencia Económica </h6>
                                <p class="h_const_p">
                                    Cuando los Acuerdos Unilaterales de Confidencialidad involucran la divulgación de información relacionada con prácticas comerciales, estrategias de mercado o secretos empresariales, la Ley Federal de Competencia Económica puede aplicarse. Esta ley prohíbe prácticas monopólicas y anticompetitivas, asegurando que la confidencialidad no se utilice indebidamente para limitar la competencia en el mercado.
                                </p> 
                            </div>
                            <div class="para_h_const">
                                <h6 class="creac">Legislación en materia de datos personales </h6>
                                <p class="h_const_p">
                                    Si el acuerdo implica el manejo de datos personales, también es relevante la legislación en materia de datos personales. Esta legislación busca proteger la privacidad y los derechos de los titulares de datos, estableciendo condiciones para la recopilación, procesamiento y transferencia de información personal, así como la obligación de garantizar la seguridad de estos datos.
                                </p> 
                                <p class="h_const_p">
                                    Es esencial tener en mente que esta lista no es exhaustiva y que las particularidades de cada situación pueden requerir la consideración de otras regulaciones o leyes específicas. Asegurar la conformidad con la legislación aplicable es esencial para resguardar la confidencialidad y los derechos de ambas partes en los Acuerdos Unilaterales de Confidencialidad en México. Contar con un contrato sólido respaldado por la legislación vigente brinda seguridad y certeza a ambas partes, estableciendo un marco de confianza y protección en la gestión de información confidencial.                                    </p> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>




<!---------------------------------------------------- section7 start------------------------------------>

<section class="sec7_cont_out dark p_120 pb-0">
    <div class="container">
        <div class="const_bg_sec7">
            <div class="const_hed_sec7">
                <h2>
                    {{ $document->guide_main_heading ?? 'Obtén tu Acuerdo Unilateral de Confidencialidad en solo 2 pasos' }}
                </h2>
            </div>


            <div class="sec7_const_content">
                <div class="container">
                    <div class="row">
                        @if(isset($document->documentGuide))
                            @foreach($document->documentGuide as $guide)
                                <div class="col-lg-6">
                                    <div class="sec7_const_h b_right">
                                        <div class="sec7_const_img">
                                            <img src="img/sec7_1img.png" alt="">
                                        </div>
                                        <div class="h_sec_const">
                                            <h6>{{ $guide->step_title ?? 'Crea tu acuerdo' }}</h6>
                                            <p>
                                                {!! $guide->step_description ?? 'Utiliza nuestro Generador de Acuerdos para crear tu acuerdo personalizado en
                                                solo unos minutos, permitiéndote elaborar el documento de acuerdo a tus
                                                necesidades específicas.' !!}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

<!---------------------------------------------------- section8 start------------------------------------>


<section class="sec8_cont_ot light p_120">
    <div class="inside_sec8_const">
        <div class="container">
            <div class="row">
                @if(isset($document->relatedDocuments))
                    @foreach($document->relatedDocuments as $rdoc)
                        <div class="col-lg-3 col-md-6 p-0 mb-2">
                            <div class="inside_box_b" style="width: 100%; display: inline-block;">
                                <div class="inside_box_tab">
                                    <div class="img_tab_sec">
                                        <img src="{{ asset('storage') }}/{{ $rdoc->document_image }}" alt="">
                                    </div>
                                    <div class="cont_tab_ot">
                                        <div class="tab_ot_text">

                                            <div class="tab_text">
                                                <h5 class=" size20">
                                                   {{ $rdoc->title ?? '' }}
                                                </h5>
                                                <ul class="tab_ul">
                                                    <li> <img src="img/stars.png" alt=""></li>
                                                    <li>4.6</li>
                                                </ul>
                                            </div>
                                            <div class="tab_2text light">
                                                {!! \Illuminate\Support\Str::words($rdoc->short_description, 10, '...')  !!}
                                            </div>

                                        </div>

                                    </div>
                                    <div class="tab_btn">
                                        <a href="{{ url('document') }}/{{ $document->slug }}" class="cta_blue" tabindex="-1">Crear ahora</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>

</section>


<!--------------------------------- section9 start ------------------------------------ -->

<section class="sec9_outer_cont p_120">
    <section class="clientes_slider p_140 light pt-0">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="clientes_data size20">
                        <h2>Lo que dicen nuestros clientes</h2>
                        <p>Valoramos tu opinión - Así nos califican nuestros clientes.</p>
                    </div>
                    <div class="btn-wrap">
                        <button class="prev-btn"><img src="img/left-arrow.png" alt=""></button>
                        <button class="next-btn"><img src="img/right-arrow.png" alt=""></button>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="client-slider">
                        <div class="control_box">
                            <div class="d-flex">
                                <div class="slider-img">
                                    <img src="img/slider-icon.png" alt="">
                                </div>
                                <div class="txt_slider">
                                    <h6>Jesús Castellanos</h6>
                                    <span>México </span>
                                </div>
                            </div>
                            <div class="star_img">
                                <img src="img/star.png" alt="">
                            </div>
                            <p>“Un excelente documento, bien estructurado, fácil y práctico de llenar”</p>
                            <span>Hace 7 meses</span>
                        </div>
                        <div class="control_box">
                            <div class="d-flex">
                                <div class="slider-img">
                                    <img src="img/slider-icon1.png" alt="">
                                </div>
                                <div class="txt_slider">
                                    <h6>Jesús Castellanos</h6>
                                    <span>México </span>
                                </div>
                            </div>
                            <div class="star_img">
                                <img src="img/star.png" alt="">
                            </div>
                            <p>“Un excelente documento, bien estructurado, fácil y práctico de llenar”</p>
                            <span>Hace 7 meses</span>
                        </div>
                        <div class="control_box">
                            <div class="d-flex">
                                <div class="slider-img">
                                    <img src="img/slider-icon2.png" alt="">
                                </div>
                                <div class="txt_slider">
                                    <h6>Sara Cabeza</h6>
                                    <span>Ciudad de México </span>
                                </div>
                            </div>
                            <div class="star_img">
                                <img src="img/star.png" alt="">
                            </div>
                            <p>“Rápido fácil y completo” </p>
                            <span>Hace 7 meses</span>
                        </div>
                        <div class="control_box">
                            <div class="d-flex">
                                <div class="slider-img">
                                    <img src="img/slider-icon1.png" alt="">
                                </div>
                                <div class="txt_slider">
                                    <h6>Jesús Castellanos</h6>
                                    <span>México </span>
                                </div>
                            </div>
                            <div class="star_img">
                                <img src="img/star.png" alt="">
                            </div>
                            <p>“Un excelente documento, bien estructurado, fácil y práctico de llenar”</p>
                            <span>Hace 7 meses</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</section>
@endsection