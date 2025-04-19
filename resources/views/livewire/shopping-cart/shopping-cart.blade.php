 <div>
@if($this->show === true)
         <section class="py-10 bg-gradient-to-r from-blue-800 to-blue-600  text-white">
             <div class="container mx-auto px-4">
                 <h1 class="text-3xl md:text-4xl font-bold">Seu Carrinho</h1>
                 <p class="mt-2">Revise seus itens e prossiga para o pagamento</p>
             </div>
         </section>

         <!-- Conteúdo Principal -->
         <main class="container mx-auto px-4 py-10">
             <div class="flex flex-col lg:flex-row gap-8">
                 <!-- Lista de Produtos -->
                 <div class="lg:w-2/3">
                     <div class="bg-white rounded-lg shadow-md overflow-hidden mb-6">
                         <div class="p-6 border-b border-gray-200">
                             <h2 class="text-xl font-semibold text-gray-800">Itens no Carrinho</h2>
                         </div>
                         @if($this->message)
                             <p class="text-red-500 text-2xl text-center" >{{$message}}</p>
                         @endif
                         @foreach($shoppingCart as $item)
                         <div class="p-6 border-b border-gray-200">
                             <div class="flex flex-col md:flex-row items-center">
                                 <div class="md:w-24 h-24 bg-gray-100 rounded-md overflow-hidden flex-shrink-0 mb-4 md:mb-0">
                                     <img wire:key="{{$item['photo']}}"src="{{$item['photo']}}" alt="">

                                 </div>
                                 <div class="md:ml-6 flex-grow">
                                     <div class="flex flex-col md:flex-row md:justify-between md:items-start">
                                         <div>
                                             <h3 wire:key="{{$item['name']}}" class="text-lg font-medium text-gray-800">{{$item['name']}}</h3>
                                             <p  wire:key="{{$item['description']}}" class="text-sm text-gray-500">{{$item['description']}}</p>
                                         </div>
                                         <div class="mt-4 md:mt-0 text-right">
                                             <p  wire:key="{{$item['price']}}" class="text-lg font-semibold text-#1E3A8A"> R$ {{$item['price']}}</p>
                                         </div>
                                     </div>
                                     <div class="mt-4 flex flex-col sm:flex-row justify-between items-center">
                                         <div class="flex items-center border border-gray-300 rounded-md">
                                             <button class="px-3 py-1 text-gray-600 hover:bg-gray-100">
                                                 <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
                                                 </svg>
                                             </button>
                                             <input wire:key="{{$item['quantity']}}" type="number" value="{{$item['quantity']}}" min="1" class="w-12 text-center border-0 focus:ring-0">
                                             <button class="px-3 py-1 text-gray-600 hover:bg-gray-100">
                                                 <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                                 </svg>
                                             </button>
                                         </div>
                                         <button wire:click="removeFromCart({{$item['id']}})" class="mt-2 sm:mt-0 text-red-600 hover:text-red-800 flex items-center text-sm">
                                             <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                             </svg>
                                             Remover
                                         </button>
                                     </div>
                                 </div>
                             </div>
                         </div>
                         @endforeach
                     </div>
                 </div>

                 <!-- Resumo do Pedido -->
                 <div class="lg:w-1/3">
                     <div class="bg-white rounded-lg shadow-md overflow-hidden sticky top-6">
                         <div class="p-6 border-b border-gray-200">
                             <h2 class="text-xl font-semibold text-gray-800">Resumo do Pedido</h2>
                         </div>
                         <div class="p-6">
                             <div class="space-y-4">
                                 <div class="flex justify-between">
                                     <span class="text-gray-600">Subtotal</span>
                                     <span class="font-medium">R$ {{$total}}</span>
                                 </div>
                                 <div class="border-t border-gray-200 pt-4 mt-4">
                                     <div class="flex justify-between">
                                         <span class="text-lg font-semibold">Total</span>
                                         <span class="text-lg font-semibold text-#1E3A8A">R$ {{$total}}</span>
                                     </div>
                                 </div>
                             </div>
                             <!-- Botão de Finalizar Compra -->
                             <div class="mt-6">
                                 <a>
                                 <button wire:click="createOrder()" class="w-full bg-blue-700 hover:to-primary text-white font-bold py-3 px-4 rounded-lg transition duration-300 flex items-center justify-center">
                                     <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                         <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                     </svg>
                                     Finalizar Compra
                                 </button>
                                </a>
                             </div>

                             <!-- Métodos de Pagamento -->
                             <div class="mt-6">
                                 <p class="text-sm text-gray-600 mb-2">Aceitamos os seguintes métodos de pagamento:</p>
                                 <div class="flex space-x-2">
                                     <div class="bg-gray-100 rounded p-1">
                                         <svg class="h-6 w-10" viewBox="0 0 40 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                             <rect width="40" height="24" rx="4" fill="#E6E6E6"/>
                                             <path d="M15 7H25V17H15V7Z" fill="#FF5F00"/>
                                             <path d="M15.5 12C15.5 9.8 16.6 7.9 18.3 6.7C17 5.6 15.3 5 13.5 5C9.4 5 6 8.1 6 12C6 15.9 9.4 19 13.5 19C15.3 19 17 18.4 18.3 17.3C16.6 16.1 15.5 14.2 15.5 12Z" fill="#EB001B"/>
                                             <path d="M34 12C34 15.9 30.6 19 26.5 19C24.7 19 23 18.4 21.7 17.3C23.4 16.1 24.5 14.2 24.5 12C24.5 9.8 23.4 7.9 21.7 6.7C23 5.6 24.7 5 26.5 5C30.6 5 34 8.1 34 12Z" fill="#F79E1B"/>
                                         </svg>
                                     </div>
                                     <div class="bg-gray-100 rounded p-1">
                                         <svg class="h-6 w-10" viewBox="0 0 40 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                             <rect width="40" height="24" rx="4" fill="#E6E6E6"/>
                                             <path d="M15 7H11V17H15V7Z" fill="#0079BE"/>
                                             <path d="M11.5 12C11.5 9.5 13 7.4 15 6.5C14.1 5.9 13 5.5 11.8 5.5C8.7 5.5 6.2 8.4 6.2 12C6.2 15.6 8.7 18.5 11.8 18.5C13 18.5 14.1 18.1 15 17.5C13 16.6 11.5 14.5 11.5 12Z" fill="#0079BE"/>
                                             <path d="M34 12C34 15.9 30.9 19 27 19C23.1 19 20 15.9 20 12C20 8.1 23.1 5 27 5C30.9 5 34 8.1 34 12Z" fill="#0079BE"/>
                                         </svg>
                                     </div>
                                     <div class="bg-gray-100 rounded p-1">
                                         <svg class="h-6 w-10" viewBox="0 0 40 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                             <rect width="40" height="24" rx="4" fill="#E6E6E6"/>
                                             <path d="M28.5 7.5L26 17H23L25.5 7.5H28.5Z" fill="#3C4043"/>
                                             <path d="M34 7.5L31.5 17H28.5L31 7.5H34Z" fill="#3C4043"/>
                                             <path d="M22 13.5L23 10.5C23 10.5 21.5 9 19.5 9C17.5 9 14 10.5 14 13.5C14 16.5 19 16.5 19 14.5C19 12.5 15 12.5 15 10.5" fill="#3C4043"/>
                                         </svg>
                                     </div>
                                     <div class="bg-gray-100 rounded p-1">
                                         <svg class="h-6 w-10" viewBox="0 0 40 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                             <rect width="40" height="24" rx="4" fill="#E6E6E6"/>
                                             <path d="M6 14.5V9.5H8.5C9.3 9.5 10 10.2 10 11C10 11.8 9.3 12.5 8.5 12.5H6" stroke="#3C4043" stroke-width="1.5"/>
                                             <path d="M13 9.5V14.5" stroke="#3C4043" stroke-width="1.5"/>
                                             <path d="M17 9.5V14.5H19.5C20.9 14.5 22 13.4 22 12C22 10.6 20.9 9.5 19.5 9.5H17Z" stroke="#3C4043" stroke-width="1.5"/>
                                             <path d="M25 14.5V9.5H27.5C28.3 9.5 29 10.2 29 11C29 11.8 28.3 12.5 27.5 12.5H25" stroke="#3C4043" stroke-width="1.5"/>
                                             <path d="M32 9.5V14.5" stroke="#3C4043" stroke-width="1.5"/>
                                         </svg>
                                     </div>
                                 </div>
                             </div>

                             <!-- Informações Adicionais -->
                             <div class="mt-6 text-sm text-gray-600">
                                 <p class="flex items-center mb-2">
                                     <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                         <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                     </svg>
                                     Entrega em todo o Brasil
                                 </p>
                                 <p class="flex items-center mb-2">
                                     <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                         <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                     </svg>
                                     Pagamento seguro
                                 </p>
                                 <p class="flex items-center">
                                     <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                         <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                     </svg>
                                     Suporte técnico especializado
                                 </p>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </main>
             <div class="bg-blue-700 py-4">
                 <div class="container mx-auto px-4 text-center text-gray-300 text-sm">
                     <p>&copy; 2023 MineralTech. Todos os direitos reservados.</p>
                 </div>
             </div>
@endif
 </div>

