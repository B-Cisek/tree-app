<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/themes/default/style.min.css" />
    <title>Tree</title>
</head>
<body>
    <div class="container">
        <h1>Drzewo</h1>
        <div class="d-flex flex-row mb-3">

            <input value="Rozwiń / Zwiń" type="button" class="btn btn-danger" onclick="rozwinDrzewo();">

            <div class="container flex-column">
                <form name="dodaj_wezel" method="post" action="{{ route('add') }}" id="dodaj_wezel">
                    @csrf
                    <input name="text" placeholder="nazwa nowego węzła" type="text" class="form-control" required>
                    <select name="rodzic" id="rodzic" class="form-select mt-2" >
                        @foreach($category as $key => $cat)
                        <option value="{{ $cat->id }}">{{ $cat->text }}</option>
                        @endforeach
                    </select>
                    <input type="submit" value="Dodaj" name="" id="" class="btn btn-danger mt-2">
                </form>
            </div>

            <div class="container flex-column">
                <form name="edytuj-wezel" method="post" action="{{ route('update') }}" id="edytuj-wezel">
                    @csrf
                    <input name="text" placeholder="nowa nazwa węzła" type="text" class="form-control" required>
                    <select name="wezel" id="rodzic" class="form-select mt-2" >
                        @foreach($category as $key => $cat)
                            <option value="{{ $cat->id }}">{{ $cat->text }}</option>
                        @endforeach
                    </select>
                    <input type="submit" value="Zmień" name="" id="" class="btn btn-danger mt-2">
                </form>
            </div>

            <div class="container flex-column">
                <form name="usun" method="post" action="{{ route('delete') }}" id="usun">
                    @csrf
                    <select name="wezel" id="rodzic" class="form-select" >
                        @foreach($category as $key => $cat)
                            @if(!($cat->parent == "#"))
                            <option value="{{ $cat->id }}">{{ $cat->text }}</option>
                            @endif
                        @endforeach
                    </select>
                    <input type="submit" value="Usuń" class="btn btn-danger mt-2">
                </form>
            </div>
        </div>
        <input id="search" type="text" class="form-control w-100 mb-2" placeholder="Szukaj">
        <div id="tree-container"></div>
    </div>



    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/jstree.min.js"></script>
    <script type="text/javascript">
        // inicjalizacja drzewa
        let data = {!! $json !!};
        $.jstree.defaults.core.themes.responsive = true;
        $('#tree-container').jstree({
            plugins: ["sort", "types", "wholerow", "search"],
            "types": {
                "file": {
                    "icon": "jstree-file"
                }
            },
            'core': {
                'data': data
            }
        });

        // szukanie
        let to = false;
        $('#search').keyup(function () {
            if(to) { clearTimeout(to); }
            to = setTimeout(function () {
                let v = $('#search').val();
                $('#tree-container').jstree(true).search(v);
            }, 250);
        });


        // sortowanie
        $(function () {
            $("#tree-container").jstree({
                "plugins" : [ "sort" ]
            });
        });

        // rozwin / zwiń drzewo
        let rozwiniete = 0;

        function rozwinDrzewo() {
            if(rozwiniete == 0) {
                rozwiniete = 1;
                $("#tree-container").jstree('open_all');
            } else {
                rozwiniete = 0;
                $("#tree-container").jstree('close_all');
            }
        }
    </script>
</body>
</html>
