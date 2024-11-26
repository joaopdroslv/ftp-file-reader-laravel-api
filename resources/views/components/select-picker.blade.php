<!--
    Temporary container
-->
<div class="main-container">
    <!--Material Icons-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    
    <!-- Importando o CSS local -->
    <link href="{{ asset('assets/css/styles.css') }}" rel="stylesheet">
    
    <!-- CSS do Bootstrap 5.3.3 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!--Custom Select Picker-->
    <div class="wrapper">
        <label for="" class="form-label fs-5">Select an item</label>
        <div class="select-btn">
            <span>Click here to select</span>
            <i class="material-icons">arrow_drop_down</i>
        </div>
        <div class="content">
            <div class="search">
                <i class="material-icons">search</i>
                <input type="text" placeholder="Search here...">
                <ul class="options"></ul>
            </div>
        </div>
    </div>

    <!-- JQuery -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
    
    <!-- JS do Bootstrap 5.3.3 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    
    <!-- Importando o JS local -->
    <!-- <script src="{{ asset('assets/js/scripts.js') }}"></script> -->
    
    <script>
        const wrapper = document.querySelector(".wrapper");
        const selectBtn = wrapper.querySelector(".select-btn");
        const searchInput = wrapper.querySelector("input");
        const options = wrapper.querySelector(".options");

        let items = @json($items);

        function truncateText(text, maxLength) {
            return text.length > maxLength ? text.slice(0, maxLength) + "..." : text;
        }

        function addItem(selectedItem) {
            options.innerHTML = "";
            items.forEach(item => {
                let isSelected = item == selectedItem ? "selected" : "";
                let truncatedItem = truncateText(item, 30);
                let li = `<li onclick="updateName(this)" class="${isSelected}" title="${item}">${truncatedItem}</li>`;
                options.insertAdjacentHTML("beforeend", li);
            });
        }
        addItem();

        function updateName(selectedLi) {
            searchInput.value = "";
            addItem(selectedLi.title);
            wrapper.classList.remove("active");
            selectBtn.firstElementChild.innerText = selectedLi.innerText;
        }

        searchInput.addEventListener("keyup", () => {
            let arr = [];
            let searchedValue = searchInput.value.toLocaleLowerCase();
            arr = items.filter(item => {
                return item.toLowerCase().includes(searchedValue);
            }).map(item => {
                let truncatedItem = truncateText(item, 30);
                return `<li onclick="updateName(this)" title="${item}">${truncatedItem}</li>`;
            }).join("");
            options.innerHTML = arr ? arr : `<p>Ops! Nothing found...</p>`;
        });

        selectBtn.addEventListener("click", () => {
            wrapper.classList.toggle("active");
        });
    </script>
</div>

