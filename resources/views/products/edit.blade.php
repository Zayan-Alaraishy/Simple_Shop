<x-layout>
    <form class="bg0 p-t-75 p-b-85"  action="/products/{{ $product->id }}" method="POST"  enctype="multipart/form-data" >
        @csrf
        @method('PUT')

        <div class="container">
            <div class="dis-flex flex-col flex-m bor12 p-t-15 p-b-30">
                <div class="size-210 p-r-18 p-r-0-sm w-full-ssm">
                    <h4 class="mtext-105 cl2 js-name-detail p-b-14 txt-center">
                        Edit Product
                    </h4>
                    <div class="p-t-15">
                        <div class="bg0 m-b-12">
                            <x-input type="text" name="name" value="{{ $product->name }}" placeholder='Name' />
                            @error('name')
                                <x-error>{{ $message }}</x-error>
                            @enderror
                        </div>

                        <div class="bg0 m-b-12">
                            <x-textarea name="description">{{ $product->description }}</x-textarea>
                            @error('description')
                                <x-error>{{ $message }}</x-error>
                            @enderror
                        </div>

                        <div class="bg0 m-b-12">
                            <x-select name="category_id">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ $product->category_id  == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </x-select>
                            @error('category_id')
                                <x-error>{{ $message }}</x-error>
                            @enderror
                        </div>

                        <div class="bg0 m-b-12">
                            <x-input type="number" name="unit_price" min="0" step="0.01" value="{{ $product->unit_price }}" placeholder='Unit Price' />
                            @error('unit_price')
                                <x-error>{{ $message }}</x-error>
                            @enderror
                        </div>

                        <div class="bg0 m-b-12">

                            <x-checkbox label='visibility' labelText="Visible?" name="visibility" value="1" {{ $product->visibility ? 'checked' : '' }} />

                            @error('visibility')
                                <x-error>{{ $message }}</x-error>
                            @enderror
                        </div>

                        <div class="bg0 m-b-12">
                            <x-input type="number" name="stock" min="0" value="{{ $product->stock }}" placeholder="Stock" />
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
                    <x-button>Update</x-button>
                </div>
            </div>
        </div>
    </form>
</x-layout>
