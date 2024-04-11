<x-mail::message>
# Ciao {{ $username }}

Il tuo nuovo progetto "{{ $project_title }}"è stato creato correttamente

<x-mail::button :url="$project_url">
Vai al progetto
</x-mail::button>

Grazie,<br>
{{ config('app.name') }}
</x-mail::message>