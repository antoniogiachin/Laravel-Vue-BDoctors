<html>
    <h1>Dottor {{ $doctorName }} - {{ $doctorSurname }}</h1>
    <p>Lei ha ricevuto un nuovo contatto da </p>
    <p> <strong>{{ $lead->author }}</strong> email : <strong>{{ $lead->email }}</strong> </p>
    <p>
        Contenuto: {{ $lead->message }}
    </p>
</html>
