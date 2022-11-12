<form action="{{route('process_login')}}" method="POST">
    @csrf
    Email
    <input type="email" name="email">
    <br>
    Password 
    <input type="password" name="password">
    <br>
    <button>Success</button>
</form>