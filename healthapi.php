<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blogs</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <section class="w-screen py-20">
        <h1 class="mb-12 text-center font-sans text-5xl font-bold">Our Blog</h1>
        <div id="blog-container"
            class="mx-auto grid max-w-screen-lg grid-cols-1 gap-5 p-5 sm:grid-cols-2 md:grid-cols-3 lg:gap-10">
        </div>
        <!-- Load More Button -->
        <div class="text-center">
            <button id="load-more-btn" class="py-3 px-6 mt-8 bg-indigo-500 text-white font-semibold rounded-md shadow-lg hover:bg-indigo-600 focus:outline-none">
                Load More
            </button>
        </div>
    </section>

    <script>
        let currentPage = 1;  // Track the current page
        const articlesPerPage = 3; // Number of articles per page

        // Fetch articles based on the page number
        const fetchNews = async (page) => {
            try {
                const url = `https://newsapi.org/v2/everything?q=doctor+health&from=2024-11-15&pageSize=${articlesPerPage}&page=${page}&sortBy=popularity&apiKey=42bafdcb7782478d94fe0f0d4f32ad0d`;

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
                        <div class="relative pb-4 flex items-center justify-center">
                            <a href="${item.url}" target="_blank" class="py-3 px-5 bg-indigo-500 text-white font-semibold rounded-md shadow-lg shadow-indigo-500/50 focus:outline-none">
                                Read full Article
                            </a>
                        </div>
                    </article>`;
                });

                // Insert articles into the container
                document.getElementById("blog-container").innerHTML += articlesHTML;

            } catch (error) {
                console.error("Error fetching news:", error);
            }
        };

        // Initial load of articles
        fetchNews(currentPage);

        // Event listener for the "Load More" button
        document.getElementById("load-more-btn").addEventListener("click", () => {
            currentPage++; // Increment the page number
            fetchNews(currentPage); // Fetch new articles
        });
    </script>
</body>

</html>
