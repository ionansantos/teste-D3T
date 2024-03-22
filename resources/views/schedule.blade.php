<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- outros metadados, links para estilos e scripts -->
    <title>Agenda</title>
</head>
<body>
    @extends('layoult')

    @section('title', 'Agenda')

    @section('content')
        <schedule></schedule> <!-- Renderiza o componente Vue.js específico desta view -->
    @endsection

</body>
</html>
