function updateChatMessages(collection, name, chatId, userId, status) {
    // Ambil elemen dengan ID chatMessage
    const chatContainer = document.getElementById('chatMessage');
    
    // Pastikan elemen chatMessage ada
    if (!chatContainer) {
        console.error('Element with ID "chatMessage" not found.');
        return;
    }
    
    // Kosongkan kontainer sebelumnya
    chatContainer.innerHTML = '';

    // Foreach pada collection untuk menambahkan pesan ke dalam chatMessage
    collection.forEach(item => {
        // Buat elemen div untuk pesan
        const messageDiv = document.createElement('div');
        const messageText = document.createElement('p');

        // Cek sender_id untuk menentukan posisi pesan
        if (item.sender_id == `${userId}`) {
            messageDiv.classList.add('flex', 'justify-end');
            messageText.classList.add('bg-green-500', 'text-white', 'px-4', 'py-2', 'rounded-lg', 'max-w-xs');
        } else {
            messageDiv.classList.add('flex', 'justify-start');
            messageText.classList.add('bg-gray-200', 'px-4', 'py-2', 'rounded-lg', 'max-w-xs');
        }

        // Tambahkan teks pesan
        messageText.textContent = item.message;

        // Tambahkan elemen teks ke dalam div pesan
        messageDiv.appendChild(messageText);

        // Tambahkan div pesan ke dalam kontainer
        chatContainer.appendChild(messageDiv);
        console.log(item.sender_id, userId)
    });
    
    const receiverName =document.getElementById('receiver_name');
    receiverName.innerText = name;

    const receiverInitial =document.getElementById('receiver_initial');
    receiverInitial.innerText = name.charAt(0);

    document.getElementById('chat_id').value = chatId;

    const closedChat = document.getElementById('closedChat');
    const formChat = document.getElementById('formChat');

    if (status == "open") {
        closedChat.classList.add('hidden');
        formChat.classList.remove('hidden');
        document.getElementById('dropdownEndChat').innerText = "Akhiri Obrolan ini";
    } else {
        formChat.classList.add('hidden');
        closedChat.classList.remove('hidden');  
        document.getElementById('dropdownEndChat').innerText = "Buka Obrolan ini";
    }

    document.getElementById('dropdownEndChat').href = "status/change/"+chatId;
    document.getElementById('endedChat').href = "status/change/"+chatId;

}