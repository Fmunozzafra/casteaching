<x-casteaching-layout>

    <button id="getVideos" type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
        GET VIDEOS
    </button>

    <script>
        async function getVideos(){
            return await window.axios.get('http://casteaching.test/api/videos')
        }

        document.getElementById('getVideos').addEventListener('click',async function (){
            try {
                const api = casteaching({baseUrl: 'https://casteaching.ferranmunozzafra.me/api'})
                console.log(api);
            } catch (error) {
                console.log('Error:');
                console.log(error);
            }
        })
    </script>
</x-casteaching-layout>
