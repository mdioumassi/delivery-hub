<!-- Le modal -->
<div class="modal fade" id="userModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Nouvel Utilisateur</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="userForm">
                @csrf
                <input type="hidden" name="user_type" id="userType">
                <div class="modal-body">
                    <div class="grid grid-cols-2 gap-6">
                        <div class="mb-3">
                            <label for="civility" class="block text-sm font-medium text-gray-700">Civilité</label>
                            <select name="civility" id="civility" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm
                            ">
                                <option value="">Sélectionner une civilite</option>
                                <option value="Monsieur">Monsieur</option>
                                <option value="Madame">Madame</option>
                            </select>
                            @error('civility')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="type" class="block text-sm font-medium text-gray-700">Type utilisateur</label>
                            <select name="type" id="type" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm
                            " required>
                                <option value="">Sélectionner un type</option>
                                <option value="Expéditeur">Expéditeiur</option>
                                <option value="Récepteur">Récepteur</option>
                                <option value="Gestionnaire">Gestionnaire</option>
                            </select>
                            @error('type')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-1">
                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email" name="email" id="email" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                        </div>

                        <div class="mb-1">
                            <label for="password" class="block text-sm font-medium text-gray-700">Mot de passe</label>
                            <input type="password" name="password" id="password" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                        </div>

                        <div class="mb-1">
                            <label for="name" class="block text-sm font-medium text-gray-700">Nom complet</label>
                            <input type="text" name="name" id="name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                        </div>

                        <div class="mb-1">
                            <label for="phone" class="block text-sm font-medium text-gray-700">Téléphone</label>
                            <input type="text" name="phone" id="phone" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                        </div>

                        <div class="mb-1">
                            <label for="street" class="block text-sm font-medium text-gray-700">Rue</label>
                            <input type="text" name="street" id="street" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                        </div>

                        <div class="mb-1">
                            <label for="city" class="block text-sm font-medium text-gray-700">Ville</label>
                            <input type="text" name="city" id="city" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                        </div>

                        <div class="mb-1">
                            <label for="zip_code" class="block text-sm font-medium text-gray-700">Code postal</label>
                            <input type="text" name="zip_code" id="zip_code" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>
</div>