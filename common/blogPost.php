<section class="flex justify-center py-10">
    <div id="blog-container" class="grid max-w-screen-lg grid-cols-1 gap-5 p-5 sm:grid-cols-2 md:grid-cols-3 lg:gap-10">

    </div>
    <div class="flex justify-center items-center">
        <a href="/Purulia-Doctor/healthapi.php" style="text-decoration:none;"
            class="flex items-center justify-center py-3 px-5 bg-indigo-500 text-white text-sm text-center font-semibold rounded-full shadow-lg shadow-indigo-500/50 focus:outline-none">
            More
            <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                fill="none" viewBox="0 0 14 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M1 5h12m0 0L9 1m4 4L9 9" />
            </svg>
        </a>
    </div>
</section>

<script>
    const fetchNews = async (page) => {
        try {
            const url = `https://newsapi.org/v2/everything?q=doctor+health&from=2024-11-15&pageSize=3&page=${page}&sortBy=popularity&apiKey=42bafdcb7782478d94fe0f0d4f32ad0d`;
            // const url = 'https://newsapi.org/v2/everything?' +
            //     'q=Apple&' + // Added '&' to separate parameters
            //     'from=2024-11-15&' +
            //     'pageSize=20&' +
            //     'page=' + page +
            //     'sortBy=popularity&' +
            //     'apiKey=42bafdcb7782478d94fe0f0d4f32ad0d';

            // var url = 'https://newsapi.org/v2/top-headlines?' +
            //     'country=us&' +
            //     'apiKey=42bafdcb7782478d94fe0f0d4f32ad0d';
            // var req = new Request(url);


            const response = await fetch(url);
            const data = await response.json();

            if (data.status !== "ok") {
                console.error("Error fetching articles:", data.message);
                return;
            }

            let articlesHTML = "";

            data.articles.forEach((item) => {
                articlesHTML += `
                    <article class="group h-full overflow-hidden rounded-lg border-2 border-gray-200 border-opacity-60 shadow-lg">
                        <img class="w-full transform object-cover object-center transition duration-500 ease-in-out group-hover:scale-105 md:h-36 lg:h-48"
                            src="${item.urlToImage || 'https://via.placeholder.com/150'}"
                            alt="${item.title}" />
                        <h2 class="title-font inline-block cursor-pointer px-6 pt-4 pb-1 text-xs font-semibold uppercase tracking-widest text-orange-600 hover:font-bold">
                            <a href="#">${item.source.name || 'Unknown Source'}</a>
                        </h2>
                        <div class="py-1 px-6">
                            <h1 class="title-font mb-3 inline-block cursor-pointer text-xl font-extrabold tracking-wide text-gray-800">
                                <a href="${item.url}" target="_blank">${item.title}</a>
                            </h1>
                            <p class="line-clamp-6 mb-3 overflow-hidden leading-relaxed text-gray-500">${item.description || 'No description available.'}</p>
                        </div>
                        <div class="flex flex-wrap items-center justify-between px-6 pt-1 pb-4">
                            <div class="flex text-sm text-gray-500">
                                <span class="mr-1">${new Date(item.publishedAt).toLocaleDateString()}</span>
                                <span>· ${item.author || 'Unknown Author'}</span>
                            </div>
                            <div class="mt-1">
                                <span class="inline-flex items-center text-gray-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                    3.5K
                                </span>
                            </div>
                        </div>
                        <div class=" bottom-0 pb-4 flex items-center justify-center">
                            <a href="${item.url}" target="_blank" class="py-3 px-5 bg-indigo-500 text-white font-semibold rounded-md shadow-lg shadow-indigo-500/50 focus:outline-none">
                                Read full Article
                            </a>
                        </div>
                    </article>`;
            });

            document.getElementById("blog-container").innerHTML = articlesHTML;
        } catch (error) {
            console.error("Error fetching news:", error);
        }
    };

    fetchNews(1);
</script>