<body>
    <h1>Create Product</h1>

    <form class="bg0 p-t-75 p-b-85" action="/products" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="bg0 m-b-12">
            <x-input type="text" name="name" value="{{ old('name') }}" placeholder='Name' />
            @error('name')
                <x-error>{{ $message }}</x-error>
            @enderror
        </div>

        <div class="bg0 m-b-12">
            <label for="description">Description</label>
            <x-textarea name="description">{{ isset(old('description'))? old('description'): 'Description' }}</x-textarea>
            @error('description')
                <x-error>{{ $message }}</x-error>
            @enderror
        </div>

        <div class="bg0 m-b-12">
            <x-select name="category_id">
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </x-select>
            @error('category_id')
                <x-error>{{ $message }}</x-error>
            @enderror
        </div>

        <div class="bg0 m-b-12">
            <x-input type="number" name="unit_price" step="0.01" value="{{ old('unit_price') }}" placeholder='Unit Price' />
            @error('unit_price')
                <x-error>{{ $message }}</x-error>
            @enderror
        </div>

        <div class="bg0 m-b-12">
            <x-input type="checkbox" name="visibility" value="1" {{ old('visibility') ? 'checked' : '' }} />
            @error('visibility')
                <x-error>{{ $message }}</x-error>
            @enderror
        </div>

        <div class="bg0 m-b-12">
            <x-input type="number" name="stock" value="{{ old('stock') }}" placeholder="Stock" />
            @error('stock')
                <x-error>{{ $message }}</x-error>
            @enderror
        </div>

        <div class="bg0 m-b-12">
            <label for="images">Images</label>
            <input type="file" name="images[]" multiple accept="image/*">
            @error('images')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <x-button>Create</x-button>
    </form>
</body>


<x-layout>
    <form class="bg0 p-t-75 p-b-85"  action="/products" method="POST" enctype="multipart/form-data" >
        @csrf
        <div class="container">
            <div class="dis-flex flex-col flex-m bor12 p-t-15 p-b-30">
                <div class="size-210 p-r-18 p-r-0-sm w-full-ssm">
                    <h4 class="mtext-105 cl2 js-name-detail p-b-14 txt-center">
                        Create Product
                    </h4>
                    <div class="p-t-15">
                        <div class="bg0 m-b-12">
                            <x-input type="text" name="name" value="{{ old('name') }}" placeholder='Name' />
                            @error('name')
                                <x-error>{{ $message }}</x-error>
                            @enderror
                        </div>
                
                        <div class="bg0 m-b-12">
                            <label for="description">Description</label>
                            <x-textarea name="description">{{ isset(old('description'))? old('description'): 'Description' }}</x-textarea>
                            @error('description')
                                <x-error>{{ $message }}</x-error>
                            @enderror
                        </div>
                
                        <div class="bg0 m-b-12">
                            <x-select name="category_id">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </x-select>
                            @error('category_id')
                                <x-error>{{ $message }}</x-error>
                            @enderror
                        </div>
                
                        <div class="bg0 m-b-12">
                            <x-input type="number" name="unit_price" step="0.01" value="{{ old('unit_price') }}" placeholder='Unit Price' />
                            @error('unit_price')
                                <x-error>{{ $message }}</x-error>
                            @enderror
                        </div>
                
                        <div class="bg0 m-b-12">
                            <x-input type="checkbox" name="visibility" value="1" {{ old('visibility') ? 'checked' : '' }} />
                            @error('visibility')
                                <x-error>{{ $message }}</x-error>
                            @enderror
                        </div>
                
                        <div class="bg0 m-b-12">
                            <x-input type="number" name="stock" value="{{ old('stock') }}" placeholder="Stock" />
                            @error('stock')
                                <x-error>{{ $message }}</x-error>
                            @enderror
                        </div>
                
                        <div class="bg0 m-b-12">
                            <label for="images">Images</label>
                            <input type="file" name="images[]" multiple accept="image/*">
                            @error('images')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <x-button>Create</x-button>
                </div>
            </div>
        </div>
    </form>    
</x-layout>