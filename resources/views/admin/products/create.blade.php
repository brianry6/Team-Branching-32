@extends('layouts.admin')

@section('content')
<style>
/* Glassmorphic form styling */
body {
    font-family: 'Inter', sans-serif;
    background: linear-gradient(135deg, #4f46e5, #8b5cf6, #ec4899);
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
}
body::before {
    content: '';
    position: fixed;
    top: 0; left: 0;
    width: 100%;
    height: 100%;
    background: url('/images/gym-login-bg.jpg') center/cover no-repeat;
    opacity: 0.25;
    filter: blur(8px);
    z-index: -1;
}
.glass-form {
    background: rgba(255, 255, 255, 0.12);
    border: 1px solid rgba(255, 255, 255, 0.2);
    border-radius: 1.5rem;
    padding: 2.5rem;
    max-width: 600px;
    width: 90%;
    color: #fff;
    backdrop-filter: blur(20px);
    box-shadow: 0 8px 32px rgba(31, 38, 135, 0.25);
}
.glass-form h1 { text-align: center; font-size: 2rem; margin-bottom: 2rem; font-weight: 700; }
.glass-form label { display: block; font-weight: 600; margin-bottom: 0.5rem; }
.glass-form input, .glass-form select {
    width: 100%; padding: 0.5rem 0.75rem; border-radius: 0.75rem; border: 1px solid rgba(255,255,255,0.3);
    background: rgba(255,255,255,0.1); color: #fff; margin-bottom: 1rem; transition: all 0.3s ease;
}
.glass-form input::placeholder { color: rgba(255,255,255,0.7); }
.glass-form input:focus, .glass-form select:focus { outline: none; border-color: #c7d2fe; background: rgba(255,255,255,0.2); }
.glass-form select option { color: #000; background: #fff; }
.glass-form button {
    width: 100%; padding: 0.75rem; background: rgba(59, 130, 246, 0.8); color: #fff;
    font-weight: 600; border: none; border-radius: 0.75rem; cursor: pointer; transition: background 0.3s, transform 0.2s;
}
.glass-form button:hover { background: rgba(59, 130, 246, 0.95); transform: scale(1.03); }
.error-message { color: #f87171; font-size: 0.875rem; margin-top: -0.5rem; margin-bottom: 1rem; }
.dynamic-field { margin-bottom: 1rem; }
</style>

<div class="glass-form">
    <h1>Add New Product</h1>

    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Basic Inputs -->
        <div>
            <label for="Product_name">Product Name</label>
            <input type="text" name="Product_name" id="Product_name" placeholder="Enter product name" value="{{ old('Product_name') }}" required>
            @error('Product_name')<p class="error-message">{{ $message }}</p>@enderror
        </div>

        <div>
            <label for="Price">Price</label>
            <input type="number" step="0.01" name="Price" id="Price" placeholder="Enter price" value="{{ old('Price') }}" required>
            @error('Price')<p class="error-message">{{ $message }}</p>@enderror
        </div>

        <div>
            <label for="Quantity">Quantity</label>
            <input type="number" name="Quantity" id="Quantity" placeholder="Enter quantity" value="{{ old('Quantity') }}" required>
            @error('Quantity')<p class="error-message">{{ $message }}</p>@enderror
        </div>

        <div>
            <label for="SubCategory_ID">Subcategory</label>
            <select name="SubCategory_ID" id="SubCategory_ID" required>
                <option value="">Select a subcategory</option>
                @foreach($subcategories as $sub)
                    <option value="{{ $sub->SubCategory_ID }}" data-category="{{ strtolower($sub->category->Category_name ?? '') }}">
                        {{ $sub->SubCategory_name }}
                    </option>
                @endforeach
            </select>
            @error('SubCategory_ID')<p class="error-message">{{ $message }}</p>@enderror
        </div>

        <!-- Dynamic Fields -->
        <div id="dynamic-fields"></div>

        <!-- Image -->
        <div>
            <label for="Product_image">Product Image</label>
            <input type="file" name="Product_image" id="Product_image">
            @error('Product_image')<p class="error-message">{{ $message }}</p>@enderror
        </div>

        <button type="submit">Add Product</button>
    </form>
</div>

<script>
const subcategorySelect = document.getElementById('SubCategory_ID');
const dynamicFields = document.getElementById('dynamic-fields');

subcategorySelect.addEventListener('change', () => {
    const selectedOption = subcategorySelect.options[subcategorySelect.selectedIndex];
    const category = selectedOption.dataset.category;
    dynamicFields.innerHTML = ''; // Clear old fields

    if(category === 'clothes'){
        const fields = [
            { label: 'Color', name: 'Color', type: 'select', options: ['Red','Blue','Green','Black','White'] },
            { label: 'Size', name: 'Size', type: 'select', options: ['S','M','L','XL'] },
            { label: 'Brand', name: 'Brand', type: 'text' }
        ];

        fields.forEach(f => {
            const div = document.createElement('div');
            div.className = 'dynamic-field';
            if(f.type === 'select'){
                let optionsHTML = `<option value="">Select ${f.label}</option>` +
                                  f.options.map(o => `<option value="${o}">${o}</option>`).join('');
                div.innerHTML = `<label for="${f.name}">${f.label}</label>
                                 <select name="specifications[${f.name}]" id="${f.name}" required>${optionsHTML}</select>`;
            } else {
                div.innerHTML = `<label for="${f.name}">${f.label}</label>
                                 <input type="text" name="specifications[${f.name}]" id="${f.name}" placeholder="Enter ${f.label}" required>`;
            }
            dynamicFields.appendChild(div);
        });

    } else if(category === 'weights' || category === 'dumbbells'){
        const div = document.createElement('div');
        div.className = 'dynamic-field';
        div.innerHTML = `<label for="Weight">Weight (kg)</label>
                         <input type="number" step="0.1" name="specifications[Weight]" id="Weight" placeholder="Enter weight" required>`;
        dynamicFields.appendChild(div);
    }
});
</script>
@endsection
