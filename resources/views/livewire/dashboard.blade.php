<div>
    <form wire:submit.prevent="submit">
        @if(session()->has('success'))
            <div style="color: green">{{ session('success') }}</div>
        @endif
        <input>
        Name: <br><input type="text" wire:model="name"></br>
        @error('name')
            <span style="color: red"> {{ message }}</span>
        @enderror
        Email: <br><input type="email" wire:model="email"></br>
        @error('email')
            <span style="color: red">{{ $message }}</span>
        @enderror
        <button type="submit">Save</button>
    </form>
    <h3>
        List:
    </h3>
    <a href="javascript:void(0)" wire:click="addForm">Add</a>
    <table>
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Email</th>
            <th>Action</th>
        </tr>
        @php
        $i = 1;
        @endphp
        @foreach($allData as $data)
            <tr>
                <td>{{ $i }}</td>
                <td>{{ $data->name }}</td>
                <td>{{ $data->email }}</td>
                <td>
                    <a href="javascript:void(0)" wire:click="editForm({{ $data->id }})">Edit</a>
                    <a href="javascript:void(0)" wire:click="deleteForm({{ $data->id }})">Delete</a>
                </td>
            </tr>
            @php
            $i++;
            @endphp
        @endforeach
    </table>
    {{$allData->links()}}
</div>
