<x-layouts.adminpanel :title="$article->title">
    <div class="container my-4">
        <h1 class="text-center mt-3">{{$article->title}}</h1>


        <div class="text-center m-4">
            <img src="{{asset('storage/' . $article->image)}}" class="img-fluid" alt="...">
        </div>

        <div class="text-center m-4">
            {{$article->content}}
        </div>

    </div>


</x-layouts.adminpanel>
