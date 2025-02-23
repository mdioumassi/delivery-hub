<div id="addUserModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <h3 class="text-lg font-medium leading-6 text-gray-900">Ajouter un utilisateur</h3>
            <form id="addUserForm" class="mt-4">
                @csrf
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Civilité</label>
                    <select name="civility" class="shadow border rounded w-full py-2 px-3 text-gray-700">
                        <option value="Mr">Monsieur</option>
                        <option value="Mrs">Madame</option>
                        <option value="Ms">Mademoiselle</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Type utilisateur</label>
                    <select name="type" class="shadow border rounded w-full py-2 px-3 text-gray-700">
                        <option value="admin">Administrateur</option>
                        <option value="user">Utilisateur</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Email</label>
                    <input type="email" name="email" class="shadow border rounded w-full py-2 px-3 text-gray-700">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Mot de passe</label>
                    <input type="password" name="password" class="shadow border rounded w-full py-2 px-3 text-gray-700">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Nom</label>
                    <input type="text" name="name" class="shadow border rounded w-full py-2 px-3 text-gray-700">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Téléphone</label>
                    <input type="text" name="phone" class="shadow border rounded w-full py-2 px-3 text-gray-700">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Rue</label>
                    <input type="text" name="street" class="shadow border rounded w-full py-2 px-3 text-gray-700">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Ville</label>
                    <input type="text" name="city" class="shadow border rounded w-full py-2 px-3 text-gray-700">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Code postal</label>
                    <input type="text" name="zip_code" class="shadow border rounded w-full py-2 px-3 text-gray-700">
                </div>

                <div class="flex justify-end">
                    <button type="button" onclick="closeModal()" class="mr-2 px-4 py-2 bg-gray-200 text-gray-800 rounded">Annuler</button>
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">Sauvegarder</button>
                </div>
            </form>
        </div>
    </div>
</div>