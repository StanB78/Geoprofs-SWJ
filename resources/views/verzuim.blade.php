<x-app-layout>
    <div style="display: flex; justify-content: center; align-items: center; height: 100vh;">
        <div style="width: 100%; max-width: 400px; padding: 2rem; border: 1px solid #ddd; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); text-align: center;">

            <h1 style="margin-bottom: 1.5rem; color: orange;">Verzuim</h1>

            <form method="POST" action="{{ route('verzuim') }}" style="display: flex; flex-direction: column; gap: 1rem;">
                @csrf

                <h2 style="margin-bottom: 1rem; color: #555;">Aantal verlof dagen: {{ Auth::user()->leaveToken }}</h2>

                <div style="text-align: left;">
                    <label for="melding">Melding</label>
                    <input id="melding" type="text" name="melding" value="{{ old('melding') }}" required autofocus
                           style="width: 100%; padding: 0.5rem; border: 1px solid #ccc; border-radius: 4px;">
                </div>

                <div style="text-align: left;">
                    <label for="soort">Soort</label>
                    <select id="soort" name="redenverzuim"
                            style="width: 100%; padding: 0.5rem; border: 1px solid #ccc; border-radius: 4px;">
                        <option value="1">Ziekmelden</option>
                        <option value="2">Verlof vragen</option>
                    </select>
                </div>

                <div style="text-align: left;">
                    <label for="startdatum">Startdatum</label>
                    <input type="date" id="startdatum" name="startdatum" min="{{ date('Y-m-d') }}"
                           style="width: 100%; padding: 0.5rem; border: 1px solid #ccc; border-radius: 4px;">
                </div>

                <div style="text-align: left;" id="einddatum-container">
                    <label for="einddatum">Einddatum</label>
                    <input type="date" id="einddatum" name="einddatum" min="{{ date('Y-m-d') }}"
                           style="width: 100%; padding: 0.5rem; border: 1px solid #ccc; border-radius: 4px;">
                </div>

                <button type="submit" style="padding: 0.75rem; background: darkorange; color: white; border: none; border-radius: 4px; cursor: pointer;">
                    Submit
                </button>

                <div style="margin-top: 1rem;">
                    <a href="{{ route('dashboard') }}" style="color: #3490dc;">Terug</a>
                </div>
            </form>

        </div>
    </div>


    <script>
        const soortSelect = document.getElementById('soort');
        const startInput = document.getElementById('startdatum');
        const endInput = document.getElementById('einddatum');
        const endContainer = document.getElementById('einddatum-container');
        const leaveTokens = {{ Auth::user()->leaveToken }}; // User tokens

        function formatDate(date) {
            const d = new Date(date);
            const month = ('0' + (d.getMonth() + 1)).slice(-2);
            const day = ('0' + d.getDate()).slice(-2);
            return `${d.getFullYear()}-${month}-${day}`;
        }

        function updateEndDate() {
            if (!startInput.value) return;
            const startDate = new Date(startInput.value);
            const maxDate = new Date(startDate);
            if(leaveTokens == 0){
                maxDate.setDate(maxDate.getDate() + leaveTokens - 0);
            }
            else{
                maxDate.setDate(maxDate.getDate() + leaveTokens - 1);
            }


            endInput.min = formatDate(startDate);
            endInput.max = formatDate(maxDate);

            const currentEnd = new Date(endInput.value);
            if (!endInput.value || currentEnd < startDate || currentEnd > maxDate) {
                endInput.value = formatDate(startDate);
            }
        }

        function updateForm() {
            if (soortSelect.value === '1') {
                // Sick leave → hide end date
                endContainer.style.display = 'none';
                endInput.value = '';
            } else {
                // Leave request → show end date
                endContainer.style.display = 'block';
                updateEndDate();
            }
        }

        // Initial load
        updateForm();

        // Event listeners
        soortSelect.addEventListener('change', updateForm);
        startInput.addEventListener('change', updateEndDate);
    </script>



    {{--    https://sweetalert2.github.io/#--}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    @if(session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oeps...',
                text: "{{ session('error') }}",
                timer: 3000,
                showConfirmButton: false
            });
        </script>
    @endif

    @if(session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Gelukt!',
                text: "{{ session('success') }}",
                timer: 2500,
                showConfirmButton: false
            });
        </script>
    @endif

</x-app-layout>
