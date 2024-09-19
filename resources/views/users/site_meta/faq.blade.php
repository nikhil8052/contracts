@extends('users_layout.master')
@section('content')

<section class="faq-sec p-130">
    <div class="container">
        <div class="faq-head">
            <h1>Preguntas frecuentes</h1>
        </div>
        <div id="">
            <div class="accordion" id="faq">
                <div class="accordion-item">
                    <div class="accordion-header" id="faqhead1">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1" aria-expanded="true" aria-controls="collapseOne">
                            ¿Qué es la plataforma Documentos-Legales.mx?
                        </button>
                    </div>
                    <div id="faq1" class="accordion-collapse collapse show" aria-labelledby="faqhead1" data-bs-parent="#faq">
                        <div class="accordion-body">
                            <p></p>
                            <p>
                                Documentos-Legales.mx es una plataforma en línea que te permite generar contratos y documentos legales personalizados según tus necesidades. Después de crear los documentos, puedes descargarlos en los
                                formatos PDF y DOCX (Word) para imprimirlos, editarlos y/o enviarlos.
                            </p>
                            <p></p>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <div class="accordion-header" id="faqhead2">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2" aria-expanded="true" aria-controls="collapseOne">
                            ¿Cómo funciona Documentos-Legales.mx?
                        </button>
                    </div>
                    <div id="faq2" class="accordion-collapse collapse" aria-labelledby="faqhead2" data-bs-parent="#faq">
                        <div class="accordion-body">
                            <p></p>
                            <p>En Documentos-Legales.mx, puedes generar una gran variedad de contratos y documentos legales que se ajusten a tus necesidades. Para crear un documento, sigue estos pasos:</p>
                            <ol>
                                <li>Haz clic en el botón “Crear Documento” en la parte superior de la página web.</li>
                                <li>Selecciona el documento que deseas generar.</li>
                                <li>Responde las preguntas para personalizar el documento legal según tus necesidades.</li>
                                <li>Paga por el documento. Puedes realizar el pago con tarjeta de crédito, en Oxxo o por PayPal.</li>
                                <li>Descarga el documento legal en PDF y DOCX (Word) para imprimirlo, editarlo y/o enviarlo.</li>
                            </ol>
                            <p></p>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <div class="accordion-header" id="faqhead3">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3" aria-expanded="true" aria-controls="collapseOne">
                            ¿Cuánto cuesta cada documento legal?
                        </button>
                    </div>
                    <div id="faq3" class="accordion-collapse collapse" aria-labelledby="faqhead3" data-bs-parent="#faq">
                        <div class="accordion-body">
                            <p></p>
                            <p>En Documentos-Legales.mx, el costo de cada documento legal varía según su tamaño y complejidad. El precio de cada uno se muestra al finalizar el cuestionario.</p>
                            <p></p>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <div class="accordion-header" id="faqhead4">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq4" aria-expanded="true" aria-controls="collapseOne">
                            ¿Quién elabora los documentos?
                        </button>
                    </div>
                    <div id="faq4" class="accordion-collapse collapse" aria-labelledby="faqhead4" data-bs-parent="#faq">
                        <div class="accordion-body">
                            <p></p>
                            <p>Los documentos han sido redactados por abogados y especialistas en el campo, basándose en las leyes federales y estatales de los Estados Unidos Mexicanos.</p>
                            <p></p>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <div class="accordion-header" id="faqhead5">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq5" aria-expanded="true" aria-controls="collapseOne">
                            ¿Cómo puedo ver todos los documentos legales disponibles?
                        </button>
                    </div>
                    <div id="faq5" class="accordion-collapse collapse" aria-labelledby="faqhead5" data-bs-parent="#faq">
                        <div class="accordion-body">
                            <p></p>
                            <p>
                                Todos los documentos legales y/o contratos están disponibles en nuestra plataforma. Puedes seleccionar el documento que te interesa y responder las preguntas para personalizarlo. Al finalizar, podrás
                                descargarlos en PDF y DOCX (Word) para su uso.
                            </p>
                            <p></p>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <div class="accordion-header" id="faqhead6">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq6" aria-expanded="true" aria-controls="collapseOne">
                            ¿Puedo recuperar un documento legal anteriormente adquirido?
                        </button>
                    </div>
                    <div id="faq6" class="accordion-collapse collapse" aria-labelledby="faqhead6" data-bs-parent="#faq">
                        <div class="accordion-body">
                            <p></p>
                            <p>
                                Sí, todos los documentos que has comprado se encuentran en tu cuenta y se pueden descargar nuevamente sin costo alguno. En caso de eliminar tu cuenta, los documentos también se eliminarán y no se podrán
                                recuperar.
                            </p>
                            <p></p>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <div class="accordion-header" id="faqhead7">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq7" aria-expanded="true" aria-controls="collapseOne">
                            ¿Qué sucede si no encuentro un documento o contrato que necesito?
                        </button>
                    </div>
                    <div id="faq7" class="accordion-collapse collapse" aria-labelledby="faqhead7" data-bs-parent="#faq">
                        <div class="accordion-body">
                            <p></p>
                            <p>
                                Si no encuentras un documento legal en Documentos-Legales.mx, te recomendamos contactarnos a través de nuestro formulario de contacto y especificar qué documento necesitas. Nuestro equipo puede crear el
                                documento legal que falta y subirlo a la plataforma.
                            </p>
                            <p></p>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <div class="accordion-header" id="faqhead8">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq8" aria-expanded="true" aria-controls="collapseOne">
                            ¿Ofrecen asesoría legal en Documentos-Legales.mx?
                        </button>
                    </div>
                    <div id="faq8" class="accordion-collapse collapse" aria-labelledby="faqhead8" data-bs-parent="#faq">
                        <div class="accordion-body">
                            <p></p>
                            <p>
                                No, es importante destacar que Documentos-Legales.mx no proporciona asesoría legal y no es un bufete de abogados. El uso del sitio web no constituye una relación entre abogado y cliente. En nuestros Términos
                                y Condiciones, puedes obtener más información al respecto.
                            </p>
                            <p></p>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <div class="accordion-header" id="faqhead9">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq9" aria-expanded="true" aria-controls="collapseOne">
                            ¿Es necesario que los documentos que genere sean revisados por un abogado?
                        </button>
                    </div>
                    <div id="faq9" class="accordion-collapse collapse" aria-labelledby="faqhead9" data-bs-parent="#faq">
                        <div class="accordion-body">
                            <p></p>
                            <p>
                                Nuestros contratos y/o documentos legales han sido creados por abogados y especialistas en el campo, y cubren la mayoría de los casos habituales. Los contratos y/o documentos se personalizan automáticamente
                                basándose en las respuestas de cada cuestionario. Sin embargo, si no estás seguro de si el documento se adapta correctamente a tu caso, recomendamos que consultes a un abogado para que revise el documento
                                legal.
                            </p>
                            <p></p>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <div class="accordion-header" id="faqhead10">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq10" aria-expanded="true" aria-controls="collapseOne">
                            ¿Es importante contestar todas las preguntas del formulario?
                        </button>
                    </div>
                    <div id="faq10" class="accordion-collapse collapse" aria-labelledby="faqhead10" data-bs-parent="#faq">
                        <div class="accordion-body">
                            <p></p>
                            <p>No siempre es necesario contestar todas las preguntas, pero recomendamos hacerlo, ya que cada documento se genera en base a tus respuestas. Te sugerimos responder las preguntas lo más exactamente posible.</p>
                            <p></p>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <div class="accordion-header" id="faqhead11">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq11" aria-expanded="true" aria-controls="collapseOne">
                            ¿La información introducida en la página web es confidencial?
                        </button>
                    </div>
                    <div id="faq11" class="accordion-collapse collapse" aria-labelledby="faqhead11" data-bs-parent="#faq">
                        <div class="accordion-body">
                            <p></p>
                            <p>
                                Sí, toda nuestra plataforma está encriptada con SSL para brindarte mayor seguridad. Tus datos están protegidos y los pagos se realizan a través de Stripe o PayPal, por lo que no tenemos acceso a información
                                confidencial de pago.
                            </p>
                            <p></p>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <div class="accordion-header" id="faqhead12">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq12" aria-expanded="true" aria-controls="collapseOne">
                            ¿Cuál es el tiempo de entrega de los documentos legales generados?
                        </button>
                    </div>
                    <div id="faq12" class="accordion-collapse collapse" aria-labelledby="faqhead12" data-bs-parent="#faq">
                        <div class="accordion-body">
                            <p></p>
                            <p>
                                Una vez que hayas completado el cuestionario y realizado el pago, podrás descargar el documento legal de inmediato. El tiempo de entrega es prácticamente instantáneo, y podrás acceder al documento en pocos
                                segundos.
                            </p>
                            <p>
                                Nota: En el caso de pagos realizados mediante Oxxo, es posible que necesitemos aproximadamente 24 horas para recibir la notificación de pago por parte de Oxxo. Una vez que recibamos la notificación, podrás
                                descargar el documento sin ninguna demora.
                            </p>
                            <p></p>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <div class="accordion-header" id="faqhead13">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq13" aria-expanded="true" aria-controls="collapseOne">
                            ¿Puedo solicitar modificaciones en el documento después de generarlo?
                        </button>
                    </div>
                    <div id="faq13" class="accordion-collapse collapse" aria-labelledby="faqhead13" data-bs-parent="#faq">
                        <div class="accordion-body">
                            <p></p>
                            <p>
                                Nuestra plataforma te permite generar documentos personalizados de acuerdo con tus necesidades. Sin embargo, ten en cuenta que cualquier modificación que realices después de generarlo estará fuera del alcance
                                de nuestras garantías y responsabilidades.
                            </p>
                            <p></p>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <div class="accordion-header" id="faqhead14">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq14" aria-expanded="true" aria-controls="collapseOne">
                            ¿Cómo puedo contactar al servicio de atención al cliente de Documentos-Legales.mx?
                        </button>
                    </div>
                    <div id="faq14" class="accordion-collapse collapse" aria-labelledby="faqhead14" data-bs-parent="#faq">
                        <div class="accordion-body">
                            <p></p>
                            <p>
                                Puedes contactar al servicio de atención al cliente de Documentos-Legales.mx a través de nuestro formulario de contacto en el sitio web. Estaremos encantados de responder tus preguntas y brindarte la ayuda
                                que necesites.
                            </p>
                            <p></p>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <div class="accordion-header" id="faqhead15">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq15" aria-expanded="true" aria-controls="collapseOne">
                            ¿Cómo puedo realizar el pago?
                        </button>
                    </div>
                    <div id="faq15" class="accordion-collapse collapse" aria-labelledby="faqhead15" data-bs-parent="#faq">
                        <div class="accordion-body">
                            <p></p>
                            <p>Puedes realizar el pago de los documentos legales utilizando tarjeta de crédito, en Oxxo o a través de PayPal. Nuestra plataforma utiliza métodos de pago seguros para garantizar la protección de tus datos.</p>
                            <p></p>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <div class="accordion-header" id="faqhead16">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq16" aria-expanded="true" aria-controls="collapseOne">
                            ¿Qué formatos de descarga están disponibles?
                        </button>
                    </div>
                    <div id="faq16" class="accordion-collapse collapse" aria-labelledby="faqhead16" data-bs-parent="#faq">
                        <div class="accordion-body">
                            <p></p>
                            <p>Después de generar y personalizar tu documento legal, podrás descargarlo en los formatos PDF y DOCX (Word). Esto te permite imprimirlo, editarlo y enviarlo según tus necesidades.</p>
                            <p></p>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <div class="accordion-header" id="faqhead17">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq17" aria-expanded="true" aria-controls="collapseOne">
                            ¿Puedo compartir los documentos legales generados con otras personas?
                        </button>
                    </div>
                    <div id="faq17" class="accordion-collapse collapse" aria-labelledby="faqhead17" data-bs-parent="#faq">
                        <div class="accordion-body">
                            <p></p>
                            <p>
                                Sí, una vez que hayas descargado los documentos legales, puedes compartirlos con otras personas según sea necesario. Puedes enviarlos por correo electrónico, imprimirlos o distribuirlos de cualquier otra
                                manera que sea apropiada para tu situación.
                            </p>
                            <p></p>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <div class="accordion-header" id="faqhead18">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq18" aria-expanded="true" aria-controls="collapseOne">
                            ¿Los documentos generados por Documentos-Legales.mx son válidos legalmente?
                        </button>
                    </div>
                    <div id="faq18" class="accordion-collapse collapse" aria-labelledby="faqhead18" data-bs-parent="#faq">
                        <div class="accordion-body">
                            <p></p>
                            <p>
                                Los documentos generados por Documentos-Legales.mx están basados en leyes federales y estatales de los Estados Unidos Mexicanos. Sin embargo, la validez legal de un documento puede depender de varios
                                factores, como el contexto y las leyes aplicables en tu jurisdicción. Recomendamos que consultes a un abogado para asegurarte de que el documento sea válido en tu situación específica.
                            </p>
                            <p></p>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <div class="accordion-header" id="faqhead19">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq19" aria-expanded="true" aria-controls="collapseOne">
                            ¿Puedo personalizar los documentos generados según mis necesidades?
                        </button>
                    </div>
                    <div id="faq19" class="accordion-collapse collapse" aria-labelledby="faqhead19" data-bs-parent="#faq">
                        <div class="accordion-body">
                            <p></p>
                            <p>
                                Sí, nuestros documentos legales se personalizan automáticamente basándose en tus respuestas en el cuestionario. Esto te permite adaptar el documento a tus necesidades específicas y obtener un resultado
                                personalizado.
                            </p>
                            <p></p>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <div class="accordion-header" id="faqhead20">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq20" aria-expanded="true" aria-controls="collapseOne">
                            ¿Los documentos generados por Documentos-Legales.mx son actualizados según cambios en la ley?
                        </button>
                    </div>
                    <div id="faq20" class="accordion-collapse collapse" aria-labelledby="faqhead20" data-bs-parent="#faq">
                        <div class="accordion-body">
                            <p></p>
                            <p>
                                Nuestro equipo se esfuerza por mantener los documentos actualizados en función de los cambios en la ley. Sin embargo, ten en cuenta que las leyes pueden cambiar y es posible que los documentos no reflejen los
                                cambios más recientes. Te recomendamos verificar la legislación vigente y consultar a un abogado para obtener asesoramiento legal actualizado.
                            </p>
                            <p></p>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <div class="accordion-header" id="faqhead21">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq21" aria-expanded="true" aria-controls="collapseOne">
                            ¿Puedo obtener un reembolso si no estoy satisfecho con el documento generado?
                        </button>
                    </div>
                    <div id="faq21" class="accordion-collapse collapse" aria-labelledby="faqhead21" data-bs-parent="#faq">
                        <div class="accordion-body">
                            <p></p>
                            <p>
                                En Documentos-Legales.mx, nos esforzamos por brindar documentos de calidad y precisión. Sin embargo, debido a la naturaleza de los productos digitales y personalizados, no ofrecemos reembolsos una vez que se
                                haya generado y descargado el documento. Te recomendamos revisar cuidadosamente tus respuestas antes de generar el documento para garantizar su precisión y adecuación a tus necesidades.
                            </p>
                            <p></p>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <div class="accordion-header" id="faqhead22">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq22" aria-expanded="true" aria-controls="collapseOne">
                            ¿Puedo usar los documentos generados más de una vez?
                        </button>
                    </div>
                    <div id="faq22" class="accordion-collapse collapse" aria-labelledby="faqhead22" data-bs-parent="#faq">
                        <div class="accordion-body">
                            <p></p>
                            <p>Sí, una vez que hayas generado y descargado un documento legal, puedes utilizarlo tantas veces como desees. No hay restricciones en cuanto al número de veces que puedes utilizar un documento específico.</p>
                            <p></p>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <div class="accordion-header" id="faqhead23">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq23" aria-expanded="true" aria-controls="collapseOne">
                            ¿Puedo guardar mis documentos en línea para acceder a ellos en cualquier momento?
                        </button>
                    </div>
                    <div id="faq23" class="accordion-collapse collapse" aria-labelledby="faqhead23" data-bs-parent="#faq">
                        <div class="accordion-body">
                            <p></p>
                            <p>Sí, todos los documentos que hayas comprado y descargado estarán disponibles en tu cuenta de Documentos-Legales.mx. Podrás acceder a ellos en cualquier momento y descargarlos nuevamente si es necesario.</p>
                            <p></p>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <div class="accordion-header" id="faqhead24">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq24" aria-expanded="true" aria-controls="collapseOne">
                            ¿Puedo eliminar mi cuenta de Documentos-Legales.mx?
                        </button>
                    </div>
                    <div id="faq24" class="accordion-collapse collapse" aria-labelledby="faqhead24" data-bs-parent="#faq">
                        <div class="accordion-body">
                            <p></p>
                            <p>
                                Sí, puedes eliminar tu cuenta de Documentos-Legales.mx en cualquier momento. Sin embargo, ten en cuenta que al hacerlo, perderás acceso a los documentos que hayas adquirido y descargado. Asegúrate de guardar
                                los documentos en un lugar seguro antes de eliminar tu cuenta.
                            </p>
                            <p></p>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <div class="accordion-header" id="faqhead25">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq25" aria-expanded="true" aria-controls="collapseOne">
                            ¿Dónde puedo encontrar los Términos y Condiciones de uso de Documentos-Legales.mx?
                        </button>
                    </div>
                    <div id="faq25" class="accordion-collapse collapse" aria-labelledby="faqhead25" data-bs-parent="#faq">
                        <div class="accordion-body">
                            <p></p>
                            <p>Puedes encontrar los Términos y Condiciones de uso de Documentos-Legales.mx en nuestro sitio web, en el enlace proporcionado en la parte inferior de la página.</p>
                            <p></p>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <div class="accordion-header" id="faqhead26">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq26" aria-expanded="true" aria-controls="collapseOne">
                            ¿Los documentos generados por Documentos-Legales.mx son personalizables después de la descarga?
                        </button>
                    </div>
                    <div id="faq26" class="accordion-collapse collapse" aria-labelledby="faqhead26" data-bs-parent="#faq">
                        <div class="accordion-body">
                            <p></p>
                            <p>
                                Una vez que hayas descargado los documentos, puedes editarlos según tus necesidades utilizando programas de edición de PDF o Word. Esto te permite realizar cambios o agregar información adicional según sea
                                necesario.
                            </p>
                            <p></p>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <div class="accordion-header" id="faqhead27">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq27" aria-expanded="true" aria-controls="collapseOne">
                            ¿Puedo solicitar la creación de un documento personalizado que no esté disponible en la plataforma?
                        </button>
                    </div>
                    <div id="faq27" class="accordion-collapse collapse" aria-labelledby="faqhead27" data-bs-parent="#faq">
                        <div class="accordion-body">
                            <p></p>
                            <p>
                                Sí, si necesitas un documento legal personalizado que no esté disponible en nuestra plataforma, puedes contactarnos a través de nuestro formulario de contacto y proporcionarnos los detalles del documento que
                                necesitas. Nuestro equipo evaluará tu solicitud y te informará si podemos crear el documento y subirlo a la plataforma.
                            </p>
                            <p></p>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <div class="accordion-header" id="faqhead28">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq28" aria-expanded="true" aria-controls="collapseOne">
                            ¿Cómo puedo obtener ayuda si encuentro algún problema con la plataforma o los documentos generados?
                        </button>
                    </div>
                    <div id="faq28" class="accordion-collapse collapse" aria-labelledby="faqhead28" data-bs-parent="#faq">
                        <div class="accordion-body">
                            <p></p>
                            <p>
                                Si encuentras algún problema con la plataforma o los documentos generados, puedes contactar a nuestro servicio de atención al cliente a través de nuestro formulario de contacto. Estaremos encantados de
                                ayudarte y resolver cualquier problema que puedas enfrentar.
                            </p>
                            <p></p>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <div class="accordion-header" id="faqhead29">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq29" aria-expanded="true" aria-controls="collapseOne">
                            ¿Puedo sugerir mejoras o nuevas características para la plataforma Documentos-Legales.mx?
                        </button>
                    </div>
                    <div id="faq29" class="accordion-collapse collapse" aria-labelledby="faqhead29" data-bs-parent="#faq">
                        <div class="accordion-body">
                            <p></p>
                            <p>
                                Sí, valoramos las sugerencias de nuestros usuarios. Si tienes alguna idea para mejorar la plataforma o te gustaría ver nuevas características agregadas, puedes enviarnos tus sugerencias a través de nuestro
                                formulario de contacto. Apreciamos tu retroalimentación y trabajamos constantemente para hacer de Documentos-Legales.mx una plataforma más útil y eficiente.
                            </p>
                            <p></p>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <div class="accordion-header" id="faqhead30">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq30" aria-expanded="true" aria-controls="collapseOne">
                            ¿Cómo puedo facturar mi compra?
                        </button>
                    </div>
                    <div id="faq30" class="accordion-collapse collapse" aria-labelledby="faqhead30" data-bs-parent="#faq">
                        <div class="accordion-body">
                            <p></p>
                            <p>Puedes facturar tu compra <a href="https://documentos-legales.mx/factura/">aquí</a>. Asegúrate de tener a mano tu RFC, número de pedido y correo electrónico.</p>
                            <p></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="footer_bann_wreap p-130 faqft">
    <div class="container">
        <div class="global_content text-center">
            <h2>Empieza a crear tus documentos legales</h2>
            <p class="bl_sec">Nuestro sistema te guía paso a paso, genera tus documentos totalmente personalizados y te permite descargarlos en los formatos PDF y DOCX (Word) de forma inmediata.</p>

            <div class="start_new text-center">
                <a href="https://documentos-legales.mx/contratos-documentos-legales/" class="cta">Comienza ahora</a>
            </div>
        </div>
    </div>
</section>


@endsection