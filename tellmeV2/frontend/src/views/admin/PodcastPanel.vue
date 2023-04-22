
<template>
   <div class=" overflow-hidden rounded shadow-lg ">
    <div class="h-full overflow-auto">
        <table class="">
            <thead>
                <tr class="text-sm font-semibold tracking-wide text-left text-white bg-blue-600 rounded uppercase border-b border-gray-600">
                    <th class="py-4 px-6 ">Cover</th>
                    <th class="py-4 px-6 ">Title</th>
                    <th class="py-4 px-6 ">Author</th>
                    <th class="py-4 px-6 ">Category</th>
                    <th class="py-4 px-6 ">Rating</th>
                    <th class="py-4 px-6 ">Description</th>
                    <th class="py-4 px-6 ">Archived</th>
                    <th class="py-4 px-6 ">Created</th>
                    <th class="py-4 px-6  ">Action</th>


                </tr>
            </thead>
            <tbody class="bg-white">
                <!-- @foreach ($books as $book)
                    <tr class="text-gray-700">
                        <td class="p-2  border">
                            <div class="flex items-center">
                                <div class=" w-24 h-32 overflow-hidden rounded">
                                    <img class="object-fit w-full h-full " src="{{$book->cover ?  asset("storage/$book->cover") : asset("/books/python.png")}}" alt="" loading="lazy" />

                                </div>

                            </div>
                        </td>
                        <td class="px-4 py-3 text-sm font-semibold border">{{ $book->title }}</td>

                        <td class="px-4 py-3 text-sm font-semibold border">{{ $book->author }}</td>
                        <td class="px-4 py-3 text-sm font-semibold border">{{ $book->category->name }}</td>

                        <td class="px-4 py-3 text-sm border">{{ $book->rating }}</td>
                        <td class="px-4 py-3 text-sm border">{{ $book->title }}</td>
                        <td class="px-4 py-3 text-sm border">
                            <h1 class=" font-meduim leading-relaxed {{ $book->archived? "text-red-600" : "text-green-600"  }} ">
                                {{$book->archived ? "True" : "False"}}
                             </h1>

                        </td>
                        <td class="px-4 py-3 text-sm border">{{ $book->created_at }}</td>
                        <td class="py-4 px-6 text-sm border space-x-2 text-center ">
                            <a href="/admin/books/{{$book->id}}/edit"> <i class="fa-solid fa-pen-to-square text-green-600"></i></a>

                            <a href="/admin/books/{{$book->id}}/delete"> <i class="fa-solid fa-trash-can text-red-600"></i></a>

                        </td>
                    </tr>
                @endforeach -->

            </tbody>
        </table>
    </div>
</div>

</template>

<script>

export default {
    name: "podcastPanel",
    components:{
        
    },
    data() {
        return {
            admin: {},
         
        };
    },
  
    
};
</script>

<style scoped>

</style>
