const serverUrl = 'http://127.0.0.1:8000/'


const newsData = [
    {
        id: 1,
        title: "Breaking News: Major Event",
        description: "A major event occurred today, shaking the world...",
        categoryId: 101,
        image:'https://images.freeimages.com/images/large-previews/2cd/chain-link-fence-1187941.jpg?fmt=webp&h=350'

    },
    {
        id: 2,
        title: "Technology Advancement",
        description: "New technological breakthrough announced, promising...",
        categoryId: 102,
        image:'https://images.freeimages.com/images/large-previews/2cd/chain-link-fence-1187941.jpg?fmt=webp&h=350'
    },
    {
        id: 3,
        title: "Sports Update",
        description: "In the latest match, the underdog team emerged victorious...",
        categoryId: 103,
        image:'https://images.freeimages.com/images/large-previews/2cd/chain-link-fence-1187941.jpg?fmt=webp&h=350'
    },
];

const newsBusinessData = [
    {
        id: 4,
        title: "Breaking News: Major Event",
        description: "A major event occurred today, shaking the world...",
        categoryId: 101,
        image:'https://images.freeimages.com/images/large-previews/2cd/chain-link-fence-1187941.jpg?fmt=webp&h=350'

    },
    {
        id: 5,
        title: "Technology Advancement",
        description: "New technological breakthrough announced, promising...",
        categoryId: 102,
        image:'https://images.freeimages.com/images/large-previews/2cd/chain-link-fence-1187941.jpg?fmt=webp&h=350'
    },
    {
        id: 6,
        title: "Sports Update",
        description: "In the latest match, the underdog team emerged victorious...",
        categoryId: 103,
        image:'https://images.freeimages.com/images/large-previews/2cd/chain-link-fence-1187941.jpg?fmt=webp&h=350'
    },
];



document.addEventListener('DOMContentLoaded', function() {

    displayHeadline()
    fetchData()

    displayNavbar()
});


function displayHeadline(){
    const headlineContainer = document.getElementById('headlineContainer');

    const headlineCard = newsData.map((news)=>{
        const newImg = serverUrl+'images/news.webp'
        const iconHeart = serverUrl+'images/heart1.png';

        return(
            `
                <a href="#" data-news-id=${news.id}>
                    <div class='w-[350px] h-[300px] relative hover:scale-[110%]'>
                        <img src="${newImg}" alt={title} class='object-cover w-full h-full absolute top-0 left-0 z-1' />
                        <div class='w-full h-full flex flex-col relative z-2 items-center justify-end p-3 bg-gradient-to-b from-transparent to-black font-thin'>
                            <p class='text-sm'>NASA Spots Asteroid 2024 DW Which Is Closer Than Moon Towards Earth Today</p>
                            <img src="${iconHeart}" onclick="addFavoris(${news.id})" id="icon-heart" class="" alt="" srcset="" style="position: relative;background: white;bottom: 90%;left: 45%;border-radius: 15px;padding: 5px">
                        </div>
                    </div>
                </a>

            `
        )
    })



    headlineContainer.innerHTML += headlineCard.join('')
}

function displaYBusinessNews(newsData){

    const newsContainer = document.getElementById('news-container');
    newsContainer.innerHTML = '';

    newsData.forEach((category) => {
        const newsCategory = category.categoryTitle;

        const sectionTitle = document.createElement('h1');
        sectionTitle.classList.add('text-5xl');
        sectionTitle.textContent = newsCategory;

        newsContainer.appendChild(sectionTitle)

        category.posts.forEach((news) => {

            const newImg = serverUrl + 'images/news.webp';
            const iconHeart = news.favorise === 'not like'?serverUrl + 'images/heart1.png':serverUrl + 'images/heart2.png'


            const newsCard = `
                <div data-news-id=${news.id} class='md:w-[900px] w-[400px] h-[400px] sm:h-[250px] flex flex-col sm:flex-row gap-2 items-center justify-center border border-slate-900 my-4 sm:p-3 py-3 rounded-sm'>
                    <img src="${news.image}" alt="title" class='sm:w-[200px] w-full h-[170px] my-1  sm:h-[200px] object-cover'/>
                    <div class='px-3'>
                        <h1 class='text-[15px] sm:text-lg my-1'>${news.title}</h1>
                        <p class='sm:text-sm text-[13px] text-gray-400 my-1 font-thin'>${news.description}</p>
                        <p class='text-md text-gray-300 my-1'>Admin</p>
                        <a href=${news.link} target="_blank" class='text-sm mt-3 font-light flex gap-2 items-center text-[#fc444a] '>Read More <AiOutlineArrowRight/></a>
                       ${isLoggedIn() ? `
                            <img src="${iconHeart}" onClick="addFavoris(${news.id})" id="icon-heart" class="" alt="" srcSet=""
                                 style="position: relative; left: 95%; bottom: 10%; background: white; border-radius: 15px; padding: 5px">
                        ` : ''}
                    </div>
                </div>
            `;


            newsContainer.innerHTML += newsCard;
        });
    });
}


    function toggleSidebar() {
        var sidebar = document.getElementById('sidebar');

        if (sidebar.classList.contains('hidden')) {
            // If the sidebar is hidden, replace 'hidden' with 'fixed' and 'translate-x-0'
            sidebar.classList.remove('hidden', 'translate-x-minus-100');
            sidebar.classList.add('fixed', 'translate-x-0');
        } else {
            // If the sidebar is fixed, replace 'fixed' with 'hidden' and 'translate-x-[-100%]'
            sidebar.classList.remove('fixed', 'translate-x-0');
            sidebar.classList.add('hidden', 'translate-x-minus-100');
        }
    }

    function addFavoris(newsId){
        fetch('api/favoris/'+newsId, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Authorization': `Bearer ${localStorage.getItem('token')}`,
            },
        })
            .then((response) => {
                if (!response.ok) {
                    throw new Error(`Network response was not ok: ${response.status}`);
                }
                return response.json();
            })
            .then((data) => {
                fetchData()
            })
            .catch((error) => {
                fetchData()
            });
    }

    function toLogin(){
        window.location.href = '/login';
    }

    function toRegister(){
        window.location.href = '/register';
    }

function fetchData(){
    fetch('newData')
        .then((response) => {
            if (!response.ok) {
                throw new Error(`Network response was not ok: ${response.status}`);
            }
            return response.json();
        })
        .then((data) => {

            displaYBusinessNews(data);
        })
        .catch((error) => {
            console.error('Fetch error:', error);
        });
}


function isLoggedIn(){
    const token = localStorage.getItem('token');
    return token ? true : false;
}

function displayNavbar(){
    const navRight = document.getElementById('nav-right');
    console.log(navRight)

    if (isLoggedIn()) {
        navRight.innerHTML += `
            <img id="avatarButton" onclick="openUserLogout()" type="button" data-dropdown-toggle="userDropdown" data-dropdown-placement="bottom-start" class="w-10 h-10 rounded-full cursor-pointer" src="https://imgs.search.brave.com/9B4B0npB9UuaVucFOq-IuOvQqL0rTMXvnH6OTjIVX0Q/rs:fit:500:0:0/g:ce/aHR0cHM6Ly9idWZm/ZXIuY29tL2xpYnJh/cnkvY29udGVudC9p/bWFnZXMvMjAyMi8w/My9za2l0Y2gtLTct/LnBuZw" alt="User dropdown">

        `;
    } else {
        navRight.innerHTML +=
            `<span class="w-24 text-center h-14 border border-white p-4 cursor-pointer text-sm hover:bg-[#fc444a] " onclick="toLogin()">Login</span>
            <span class="w-24 text-center h-14 border border-white p-4 cursor-pointer text-sm hover:bg-[#fc444a] " onclick="toRegister()">Register</span>`;
    }


}

function openUserLogout(){
    const userDropdown = document.getElementById('userDropdown');


    if(userDropdown.classList.contains('hidden')){
        userDropdown.classList.remove('hidden');
    }else{
        userDropdown.classList.add('hidden');
    }
}

function logout(){
    localStorage.removeItem('token');
    window.location.href = '/';
}
