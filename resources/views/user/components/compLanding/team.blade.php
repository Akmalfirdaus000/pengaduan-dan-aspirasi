<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tim Humas Pengaduan Masyarakat</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const teams = [{
                    name: "Tim 1",
                    title: "Divisi Humas Pengaduan Masyarakat",
                    desc: "Bertugas menerima, memproses, dan memberikan solusi atas pengaduan masyarakat.",
                    imageSrc: "https://via.placeholder.com/300x200",
                },
                {
                    name: "Tim 2",
                    title: "Divisi Humas Pengaduan Masyarakat",
                    desc: "Berfokus pada analisis data pengaduan untuk meningkatkan layanan masyarakat.",
                    imageSrc: "https://via.placeholder.com/300x200",
                },
                {
                    name: "Tim 3",
                    title: "Divisi Humas Pengaduan Masyarakat",
                    desc: "Mengelola komunikasi antara masyarakat dan instansi terkait untuk menyelesaikan keluhan.",
                    imageSrc: "https://via.placeholder.com/300x200",
                },
                {
                    name: "Tim 4",
                    title: "Divisi Humas Pengaduan Masyarakat",
                    desc: "Mengembangkan sistem pengaduan yang responsif dan efisien.",
                    imageSrc: "https://via.placeholder.com/300x200",
                },
                {
                    name: "Tim 5",
                    title: "Divisi Humas Pengaduan Masyarakat",
                    desc: "Melakukan sosialisasi mengenai cara pengaduan yang benar kepada masyarakat.",
                    imageSrc: "https://via.placeholder.com/300x200",
                },
                {
                    name: "Tim 6",
                    title: "Divisi Humas Pengaduan Masyarakat",
                    desc: "Menyusun laporan berkala tentang pengaduan masyarakat untuk evaluasi kebijakan.",
                    imageSrc: "https://via.placeholder.com/300x200",
                },
                {
                    name: "Tim 7",
                    title: "Divisi Humas Pengaduan Masyarakat",
                    desc: "Berinovasi dalam memanfaatkan teknologi untuk mempermudah layanan pengaduan.",
                    imageSrc: "https://via.placeholder.com/300x200",
                },
            ];

            let selected = 0;

            const updateContent = () => {
                const team = teams[selected];
                document.getElementById("desc").textContent = team.desc;
                document.getElementById("name-title").textContent = `${team.name}, ${team.title}`;
                document.getElementById("image").src = team.imageSrc;

                document.querySelectorAll(".tab-button").forEach((button, index) => {
                    if (index === selected) {
                        button.classList.add("bg-[#003f87]", "text-white");
                        button.classList.remove("bg-gray-100", "text-gray-700");
                    } else {
                        button.classList.add("bg-gray-100", "text-gray-700");
                        button.classList.remove("bg-[#003f87]", "text-white");
                    }
                });
            };

            document.querySelectorAll(".tab-button").forEach((button, index) => {
                button.addEventListener("click", () => {
                    selected = index;
                    updateContent();
                });
            });

            document.getElementById("prev-btn").addEventListener("click", () => {
                selected = (selected - 1 + teams.length) % teams.length;
                updateContent();
            });

            document.getElementById("next-btn").addEventListener("click", () => {
                selected = (selected + 1) % teams.length;
                updateContent();
            });

            updateContent();
        });
    </script>
</head>

<body class="bg-gray-50 text-gray-800">

    <section id="team" class="py-16 px-4 bg-[#003f87] mb-10">
        <h2 class="text-3xl font-bold text-center mb-8 text-white">Tim Humas Pengaduan Masyarakat</h2>

        <!-- Tabs -->
        <div class="flex flex-wrap justify-center gap-4 mb-8">
            <button
                class="px-4 py-2 rounded-full font-semibold transition tab-button shadow-md hover:bg-yellow-500 hover:text-white">Tim
                1</button>
            <button
                class="px-4 py-2 rounded-full font-semibold transition tab-button shadow-md hover:bg-yellow-500 hover:text-white">Tim
                2</button>
            <button
                class="px-4 py-2 rounded-full font-semibold transition tab-button shadow-md hover:bg-yellow-500 hover:text-white">Tim
                3</button>
            <button
                class="px-4 py-2 rounded-full font-semibold transition tab-button shadow-md hover:bg-yellow-500 hover:text-white">Tim
                4</button>
            <button
                class="px-4 py-2 rounded-full font-semibold transition tab-button shadow-md hover:bg-yellow-500 hover:text-white">Tim
                5</button>
            <button
                class="px-4 py-2 rounded-full font-semibold transition tab-button shadow-md hover:bg-yellow-500 hover:text-white">Tim
                6</button>
            <button
                class="px-4 py-2 rounded-full font-semibold transition tab-button shadow-md hover:bg-yellow-500 hover:text-white">Tim
                7</button>
        </div>

        <!-- Content -->
        <div
            class="flex flex-col md:flex-row items-center justify-center max-w-4xl mx-auto bg-white rounded-lg shadow-lg p-6">
            <div class="flex-1">
                <h3 id="desc" class="text-xl font-semibold mb-4 text-gray-700"></h3>
                <p id="name-title" class="text-gray-600"></p>
            </div>
            <div class="flex-1 flex justify-center mt-6 md:mt-0 md:ml-6">
                <img id="image" src="" alt="Team Member" class="rounded-lg shadow-lg h-52 w-auto">
            </div>
        </div>

        <!-- Navigation Buttons -->
        <div class="flex justify-center gap-6 mt-6">
            <button id="prev-btn"
                class="p-3 bg-[#003f87] text-white rounded-full shadow-lg hover:bg-blue-400 transition">←</button>
            <button id="next-btn"
                class="p-3 bg-[#003f87] text-white rounded-full shadow-lg hover:bg-blue-400 transition">→</button>
        </div>
    </section>

</body>

</html>
