@extends('front.layout')

@section('content')
<div class="flex-grow">
    <article class="text-justify mt-5 lg:mt-36 xl:mt-36">
        <p>Desde la aparición de los primeros casos de Covid en América Latina, gobiernos y prensa se preocuparon día a día de publicar las cifras de casos de personas contagiadas y de muertes. El Perú es uno de los países con más muertos de Covid por millón de habitantes, pero las cifras son frías, politizadas según la persona, institución o medio que las divulgue o interprete. Detrás de estas se esconden historias de cientos de miles de ciudadanos y ciudadanas que han sucumbido injustamente a esta pandemia. Injustamente, porque el Covid ha hecho más visibles las injusticias sociales,poniendo en claro que nuestro sistema de salud es elitista y precario. En ese sentido, planteamos un espacio de conmemoración virtual para todas esas personas escondidas detrás de las cifras.</p>
        <p>Voces y adioses es una iniciativa cívica para materializar los recuerdos de los familiares y seres queridos de las víctimas de la pandemia. Un lugar donde podamos realizar las despedidas inconclusas e imposibles a las que nos empuja la enfermedad. Un lugar inclusivo para ellas, donde quede constancia de que cada vida perdida cuenta, de que cada víctima de Covid deja un vacío inmenso en su hogar, en su comunidad y en el país. Un lugar que nos ayude a  construir una memoria colectiva de este período, en la que ninguna historia individual quede sepultada por la Historia oficial que se construirá luego. </p>
        <p>Te invitamos a participar de la  creación de un espacio donde se refugie la memoria y se cristalicen los recuerdos de los peruanos y peruanas que nos han dejado debido a la pandemia. Reconociendo y procesando colectivamente nuestras pérdidas, podremos responder mejor al presente, hacia un mañana más digno y justo para el país. Para que, aprendiendo a despedirnos, aprendamos también a cuidar y a reconocer el valor de la vida.</p>
    </article>

    <footer class="text-sm text-center mt-10 pb-5">
        ******** <br>
        Voces y adioses es una iniciativa realizada por Natalí Durand, Jesús Martínez y Eliana Otta. El diseño web ha sido hecho por Natalia Revilla y la programación por Fernando Ramos.
    </footer>
</div>
@endsection

@section('css')
<style>
article {
    -webkit-columns: 3 300px;
    -moz-columns: 3 300px;
    columns: 3 300px;    
    column-gap: 40px;
}
</style>
@endsection