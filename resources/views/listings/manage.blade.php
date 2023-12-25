@extends("layout")
@section("content")

@if(count($listings) ?? false)

<table class="w-full table-auto rounded-sm">
  <tbody>
    @foreach ($listings as $listing)
      <tr class="mt-1/3 border-gray-300">
          <td
              class="px-4 py-8 border-t border-b border-gray-300 text-lg"
          >
              <a href="/listings/{{$listing->id}}">
                 {{$listing->title}}
              </a>
          </td>
          <td
              class="px-4 py-8 border-t border-b border-gray-300 text-lg"
          >
              <a
                  href="/listings/{{$listing->id}}/edit"
                  class="text-blue-400 px-6 py-2 rounded-xl"
                  ><i
                      class="fa-solid fa-pen-to-square"
                  ></i>
                  Edit</a
              >
          </td>

            <td  class=" rounded mr-5 border-t border-b border-gray-300 ">
              <img
              class="hidden h-12 mt-5 mx-auto w-1/2 md:block"
              style="object-fit: contain"
              src={{$listing->logo ? asset( "storage/".$listing->logo) : asset("images/no-image.png")}} 
              alt="logo image"
            />

          </td>
          <td
              class="px-4 py-8 border-t border-b border-gray-300 text-lg"
          >
              <form method="POST" action="/listings/{{$listing->id}}">
                @csrf
                @method("delete")
                  <button class="text-red-600">
                      <i
                          class="fa-solid fa-trash-can"
                      ></i>
                      Delete
                  </button>
              </form>
          </td>
      </tr>

      @endforeach

      
  </tbody>
</table>

    
@else
   <p class="bg-red-500 text-white text-xl p-2 "> no listings</p> 
@endif
@endsection