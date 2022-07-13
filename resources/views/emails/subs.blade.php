@component('mail::message')
{{-- Olá, {{$newsub->nome}} --}}
{{-- Debug --}}
<p>{{ greetings_pt(\Carbon\Carbon::now()) }}, {{ $nome }}</p>
<p>Acabou de se inscrever com sucesso no Festival Dunas para o {{ $evento }} no dia {{ $dia }}.</p>
<br>
@if ($dia==20 || $dia==21)
    <p><b>Deve proceder ao levantamento do/s meu/s bilhete/s somente entre as 19h30 e as 20h30 no dia do concerto e na bilheteira do recinto, mediante apresentação do meu documento de identificação, utilizado aquando da inscrição.</b></p>
@else
    <p><b>Deve proceder ao levantamento do/s meu/s bilhete/s somente entre as 16h30 e as 17h30 no dia do concerto e na bilheteira do recinto, mediante apresentação do meu documento de identificação, utilizado aquando da inscrição.</b></p>
@endif
<br>
<p>Para dúvidas ou questões por favor contacte-nos através do <a href="m.me/festivaldunassaojacinto">Messenger.</a>
</p>
@endcomponent