
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<head>
 <title>{{ $certificate->certid }}</title>
</head>

{{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap-4-grid@3.4.0/css/grid.min.css" rel="stylesheet" /> --}}


<style>


p,h1,h2,h3,h4,h5{
    font-family:Arial, Helvetica, sans-serif;
    color:black;
}
.box {
    width: 200px;
    border: black solid 1px;
    padding: 65px;
}


</style>

<body>

    <div class="box">
        <p><strong>{{ $certificate->author->company }}</strong></p>
        <p><strong>Attn: {{ $certificate->author->fname }} {{ $certificate->author->lname }}</strong></p>
        <p>{{ $certificate->author->address }}</p>
        <p>{{ $certificate->author->city }}, {{ $certificate->author->postal }}</p>

    </div>
      
</body>
</body>
</html>