@if (session()->has("message"))
      <div x-show="open" x-data="{ open: true }" x-init="setTimeout(()=> open = false ,5000)" class=" fixed top-3 right-1/2 transform 
        border-gray-500 border-solid border-2 rounded bg-slate-800 text-white  px-48 py-3 translate-x-1/2 " > 
          <p>{{session("message")}}</p>
      </div>
@endif