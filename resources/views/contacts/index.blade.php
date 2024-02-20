@extends('layouts.base')

@section('title', 'Contacts')

@section('content')
    <table class="table table-hover mt-3">
        <thead>
            <tr>
                <th>#</th>
                <th>Nume</th>
                <th>Telefon</th>
                <th>Email</th>
                <th>Adresa</th>
                <th>Options</th>
            </tr>
        </thead>
        <tbody>
            @forelse($contacts as $contact)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$contact->nume}}</td>
                    <td>{{$contact->telefon}}</td>
                    <td>{{$contact->email}}</td>
                    <td>{{$contact->adresa}}</td>
                    <td>
                        <a href="{{ route('contacts.edit', ['contact' => $contact->id]) }}"
                           class="btn btn-sm btn-outline-warning" >
                            Edit
                        </a>
                        <button class="btn btn-sm btn-outline-danger delete-contact"
                                data-id="{{$contact->id}}">
                            Delete
                        </button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">No contacts</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <div>{{ $contacts->links() }}</div>
@endsection

@push('styles')
    <style>
        .page-link.active, .active > .page-link{
            background-color: black;
            color: white;
            border: 1px solid black;
        }
        .page-link{
            color: black;
        }
    </style>
@endpush

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const successMessage = "{{ session('success') }}";
            const deleteButtons = document.querySelectorAll('.delete-contact');
            if(deleteButtons){
                [...deleteButtons].map( btn => {
                    btn.addEventListener('click', () => {
                        const id = btn.dataset.id;
                        Swal.fire({
                            title: 'Sunteti sigur?',
                            text: "Doriti sa stergeti inregistrarea?",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#d33',
                            cancelButtonColor: '#000',
                            confirmButtonText: 'Da',
                            cancelButtonText: 'Nu'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                axios.delete(`/contacts/${id}`)
                                    .then(function (response) {
                                        if (response.data.success) {
                                            Swal.fire({
                                                title: 'Succes!',
                                                text: response.data.message,
                                                icon: 'success',
                                                confirmButtonText: 'OK',
                                                confirmButtonColor: '#d33'
                                            }).then(function () {
                                                location.reload();
                                            });
                                        }
                                    })
                                    .catch(function (error) {
                                        console.log(error);
                                        Swal.fire({
                                            title: 'Eroare!',
                                            text: 'A aparut o eroare la stergerea inregistrarii.',
                                            icon: 'error',
                                            confirmButtonText: 'OK'
                                        });
                                    });
                            }
                        });
                    });
                });
            }
            if (successMessage) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: successMessage,
                });
            }
        });
    </script>
@endpush

