<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-800 bg-gray-50">
    <header class="bg-white shadow-md fixed w-full z-10">
        <div class="container mx-auto px-4 py-3 flex justify-between items-center">
            <div class="flex items-center">
                <span class="text-primary text-2xl font-bold">MineralTech</span>
            </div>
            <nav class="hidden md:flex space-x-8">
                @if (Route::has('login'))
                            <livewire:welcome.navigation />
                @endif
            </nav>
            <div class="md:hidden">
                <button class="text-gray-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>
    </header>

    <!-- Seção Hero -->
    <section id="inicio" class="pt-24 pb-16 md:pt-32 md:pb-24 bg-gradient-to-r from-#1E3A8A to-blue-900 from-gray-900 to-primary text-white">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row items-center">
                <div class="md:w-1/2 mb-10 md:mb-0">
                    <h1 class="text-4xl md:text-5xl font-bold mb-4">Soluções em Mineração de Alta Qualidade</h1>
                    <p class="text-xl mb-8 text-gray-200">Fornecemos os melhores minerais e matérias-primas para sua indústria com compromisso sustentável.</p>
                    <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4">
                        <a href="#produtos" class="bg-accent hover:bg-yellow-600 text-white font-bold py-3 px-6 rounded-lg text-center transition duration-300 shadow-lg">
                            Nossos Produtos
                        </a>
                        <a href="#contato" class="bg-transparent hover:bg-white/10 border-2 border-white text-white font-bold py-3 px-6 rounded-lg text-center transition duration-300">
                            Fale Conosco
                        </a>
                    </div>
                </div>
                <div class="md:w-1/2">
                    <img src="https://png.pngtree.com/png-clipart/20240516/original/pngtree-vector-color-children-construction-large-surface-miner-machine-clipart-png-image_15106876.png" alt="Operação de mineração" class="rounded-lg shadow-2xl">
                </div>
            </div>
        </div>
    </section>
    <section id="produtos" class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold mb-4">Nossos Produtos</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">Oferecemos uma ampla gama de minerais e matérias-primas de alta qualidade para diversas indústrias.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="bg-gray-50 rounded-lg overflow-hidden shadow-lg transition-transform duration-300 hover:shadow-xl hover:-translate-y-1">
                    <img src="https://cdn-icons-png.flaticon.com/512/5672/5672093.png" alt="Minério de Ferro" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-bold mb-2">Minério de Ferro</h3>
                        <p class="text-gray-600 mb-4">Alta pureza para indústria siderúrgica, com diferentes granulometrias disponíveis.</p>
                    </div>
                </div>

                <div class="bg-gray-50 rounded-lg overflow-hidden shadow-lg transition-transform duration-300 hover:shadow-xl hover:-translate-y-1">
                    <img src="https://static.vecteezy.com/ti/vetor-gratis/p1/45093180-calcario-rocha-natureza-forma-realista-3d-ilustracao-em-branco-fundo-vetor.jpg" alt="Calcário" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-bold mb-2">Calcário</h3>
                        <p class="text-gray-600 mb-4">Ideal para construção civil, agricultura e tratamento de água, com certificação de qualidade.</p>
                    </div>
                </div>

                <div class="bg-gray-50 rounded-lg overflow-hidden shadow-lg transition-transform duration-300 hover:shadow-xl hover:-translate-y-1">
                    <img src="https://media.istockphoto.com/id/1151998919/pt/vetorial/heap-of-black-coal-mineral-rocks-flat-vector-isolated-on-white-background.jpg?s=612x612&w=0&k=20&c=GCmtbr3rOQUJkKSBTUBwQSM5lOypUBl2oMV3FQ9yyLM=" alt="Bauxita" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-bold mb-2">Bauxita</h3>
                        <p class="text-gray-600 mb-4">Matéria-prima para produção de alumínio, com alto teor de pureza e baixo índice de contaminantes.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="sobre" class="py-16 bg-gray-100">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row items-center">
                <div class="md:w-1/2 mb-10 md:mb-0">
                    <img src="https://img.freepik.com/vetores-gratis/conceito-de-mineracao-com-trabalhadores-montando-um-estilo-retro-dos-desenhos-animados-de-carrinho-de-carvao_1284-8106.jpg" alt="Nossa Operação" class="rounded-lg shadow-xl">
                </div>
                <div class="md:w-1/2 md:pl-12">
                    <h2 class="text-3xl md:text-4xl font-bold mb-6">Sobre a MineralTech</h2>
                    <p class="text-gray-600 mb-6">Com mais de 25 anos de experiência no setor de mineração, a MineralTech se destaca pela excelência operacional e compromisso com a sustentabilidade.</p>
                    <p class="text-gray-600 mb-6">Nossas operações seguem os mais rigorosos padrões ambientais e de segurança, garantindo produtos de alta qualidade e respeito ao meio ambiente.</p>

                    <div class="grid grid-cols-2 gap-4 mt-8">
                        <div class="flex items-center">
                            <div class="bg-yellow-500 rounded-full p-2 mr-3 ">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white " fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                            <span class="font-medium">Qualidade Certificada</span>
                        </div>
                        <div class="flex items-center">
                            <div class="bg-yellow-500 rounded-full p-2 mr-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                            <span class="font-medium">Sustentabilidade</span>
                        </div>
                        <div class="flex items-center">
                            <div class="bg-yellow-500 rounded-full p-2 mr-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                            <span class="font-medium">Tecnologia Avançada</span>
                        </div>
                        <div class="flex items-center">
                            <div class="bg-yellow-500 rounded-full p-2 mr-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                            <span class="font-medium">Entrega Pontual</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Seção de Diferenciais -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold mb-4">Nossos Diferenciais</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">O que nos torna a escolha ideal para suas necessidades em mineração.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Diferencial 1 -->
                <div class="text-center p-6 bg-gray-50 rounded-lg shadow-md">
                    <div class="inline-block p-4 bg-blue-700 rounded-full mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Qualidade Garantida</h3>
                    <p class="text-gray-600">Todos os nossos produtos passam por rigorosos controles de qualidade e possuem certificações internacionais.</p>
                </div>

                <!-- Diferencial 2 -->
                <div class="text-center p-6 bg-gray-50 rounded-lg shadow-md">
                    <div class="inline-block p-4 bg-blue-700 rounded-full mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Entrega Eficiente</h3>
                    <p class="text-gray-600">Logística otimizada para garantir que seus produtos cheguem no prazo e nas condições ideais.</p>
                </div>

                <!-- Diferencial 3 -->
                <div class="text-center p-6 bg-gray-50 rounded-lg shadow-md">
                    <div class="inline-block p-4 bg-blue-700 rounded-full mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Sustentabilidade</h3>
                    <p class="text-gray-600">Operações com baixo impacto ambiental e programas de recuperação de áreas mineradas.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Seção de Depoimentos -->
    <section class="py-16 bg-gray-100">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold mb-4">O Que Nossos Clientes Dizem</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">A satisfação de nossos parceiros é o nosso maior patrimônio.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Depoimento 1 -->
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <div class="flex items-center mb-4">
                        <div class="text-accent">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                            </svg>
                        </div>
                    </div>
                    <p class="text-gray-600 mb-4">"A qualidade dos minerais fornecidos pela MineralTech superou nossas expectativas. Nossa produção melhorou significativamente."</p>
                    <div class="flex items-center">
                        <img src="/placeholder.svg?height=50&width=50" alt="Cliente" class="w-12 h-12 rounded-full mr-4">
                        <div>
                            <h4 class="font-bold">Carlos Silva</h4>
                            <p class="text-sm text-gray-500">Diretor Industrial, Aço Brasil</p>
                        </div>
                    </div>
                </div>

                <!-- Depoimento 2 -->
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <div class="flex items-center mb-4">
                        <div class="text-accent">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                            </svg>
                        </div>
                    </div>
                    <p class="text-gray-600 mb-4">"Parceria de longo prazo que tem nos proporcionado segurança e confiabilidade no fornecimento de matérias-primas essenciais."</p>
                    <div class="flex items-center">
                        <img src="/placeholder.svg?height=50&width=50" alt="Cliente" class="w-12 h-12 rounded-full mr-4">
                        <div>
                            <h4 class="font-bold">Ana Ferreira</h4>
                            <p class="text-sm text-gray-500">Gerente de Compras, Construtora Horizonte</p>
                        </div>
                    </div>
                </div>

                <!-- Depoimento 3 -->
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <div class="flex items-center mb-4">
                        <div class="text-accent">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                            </svg>
                        </div>
                    </div>
                    <p class="text-gray-600 mb-4">"O compromisso com a sustentabilidade da MineralTech foi fundamental para nossa decisão de estabelecer esta parceria."</p>
                    <div class="flex items-center">
                        <img src="/placeholder.svg?height=50&width=50" alt="Cliente" class="w-12 h-12 rounded-full mr-4">
                        <div>
                            <h4 class="font-bold">Roberto Mendes</h4>
                            <p class="text-sm text-gray-500">CEO, EcoMinerais</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Seção de Contato -->
    <section id="contato" class="py-16 bg-blue-900 text-white">
        <div class="container mx-auto px-4 ">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold mb-4">Entre em Contato</h2>
                <p class="text-gray-200 max-w-2xl mx-auto">Estamos prontos para atender às suas necessidades. Entre em contato para solicitar uma cotação ou tirar dúvidas.</p>
            </div>

            <div class="flex flex-col md:flex-row">
                <div class="md:w-1/2 mb-10 md:mb-0 md:pr-8">
                    <form class="bg-white p-8 rounded-lg shadow-lg text-gray-800">
                        <div class="mb-4">
                            <label for="nome" class="block text-gray-700 font-medium mb-2">Nome</label>
                            <input type="text" id="nome" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                        </div>
                        <div class="mb-4">
                            <label for="email" class="block text-gray-700 font-medium mb-2">Email</label>
                            <input type="email" id="email" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                        </div>
                        <div class="mb-4">
                            <label for="telefone" class="block text-gray-700 font-medium mb-2">Telefone</label>
                            <input type="tel" id="telefone" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                        </div>
                        <div class="mb-6">
                            <label for="mensagem" class="block text-gray-700 font-medium mb-2">Mensagem</label>
                            <textarea id="mensagem" rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary"></textarea>
                        </div>
                        <button type="submit" class="w-full bg-blue-900 hover:bg-blue-900 text-white font-bold py-3 px-4 rounded-lg transition duration-300">
                            Enviar Mensagem
                        </button>
                    </form>
                </div>

                <div class="md:w-1/2 md:pl-8">
                    <div class="bg-blue-900 p-8 rounded-lg shadow-lg h-full">
                        <h3 class="text-xl font-bold mb-6">Informações de Contato</h3>

                        <div class="flex items-start mb-6">
                            <div class="bg-primary/30 rounded-full p-3 mr-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-semibold mb-1">Endereço</h4>
                                <p class="text-gray-200">Av. Mineração, 1500 - Distrito Industrial</p>
                                <p class="text-gray-200">Belo Horizonte - MG, 30000-000</p>
                            </div>
                        </div>

                        <div class="flex items-start mb-6">
                            <div class="bg-primary/30 rounded-full p-3 mr-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-semibold mb-1">Telefone</h4>
                                <p class="text-gray-200">(31) 3000-0000</p>
                                <p class="text-gray-200">(31) 99000-0000</p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <div class="bg-primary/30 rounded-full p-3 mr-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-semibold mb-1">Email</h4>
                                <p class="text-gray-200">contato@mineraltech.com.br</p>
                                <p class="text-gray-200">vendas@mineraltech.com.br</p>
                            </div>
                        </div>

                        <div class="mt-8">
                            <h4 class="font-semibold mb-4">Horário de Atendimento</h4>
                            <p class="text-gray-200 mb-2">Segunda a Sexta: 8h às 18h</p>
                            <p class="text-gray-200">Sábado: 8h às 12h</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Rodapé -->
    <footer class="bg-gray-900 text-white py-12">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-xl font-bold mb-4">MineralTech</h3>
                    <p class="text-gray-400 mb-4">Soluções em mineração com qualidade e sustentabilidade.</p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-white transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M22.675 0h-21.35c-.732 0-1.325.593-1.325 1.325v21.351c0 .731.593 1.324 1.325 1.324h11.495v-9.294h-3.128v-3.622h3.128v-2.671c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.463.099 2.795.143v3.24l-1.918.001c-1.504 0-1.795.715-1.795 1.763v2.313h3.587l-.467 3.622h-3.12v9.293h6.116c.73 0 1.323-.593 1.323-1.325v-21.35c0-.732-.593-1.325-1.325-1.325z"/>
                            </svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm6.066 9.645c.183 4.04-2.83 8.544-8.164 8.544-1.622 0-3.131-.476-4.402-1.291 1.524.18 3.045-.244 4.252-1.189-1.256-.023-2.317-.854-2.684-1.995.451.086.895.061 1.298-.049-1.381-.278-2.335-1.522-2.304-2.853.388.215.83.344 1.301.359-1.279-.855-1.641-2.544-.889-3.835 1.416 1.738 3.533 2.881 5.92 3.001-.419-1.796.944-3.527 2.799-3.527.825 0 1.572.349 2.096.907.654-.128 1.27-.368 1.824-.697-.215.671-.67 1.233-1.263 1.589.581-.07 1.135-.224 1.649-.453-.384.578-.87 1.084-1.433 1.489z"/>
                            </svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-2 16h-2v-6h2v6zm-1-6.891c-.607 0-1.1-.496-1.1-1.109 0-.612.492-1.109 1.1-1.109s1.1.497 1.1 1.109c0 .613-.493 1.109-1.1 1.109zm8 6.891h-1.998v-2.861c0-1.881-2.002-1.722-2.002 0v2.861h-2v-6h2v1.093c.872-1.616 4-1.736 4 1.548v3.359z"/>
                            </svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                            </svg>
                        </a>
                    </div>
                </div>

                <div>
                    <h3 class="text-lg font-semibold mb-4">Produtos</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-white transition">Minério de Ferro</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition">Calcário</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition">Bauxita</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition">Manganês</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition">Cobre</a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-lg font-semibold mb-4">Links Rápidos</h3>
                    <ul class="space-y-2">
                        <li><a href="#inicio" class="text-gray-400 hover:text-white transition">Início</a></li>
                        <li><a href="#produtos" class="text-gray-400 hover:text-white transition">Produtos</a></li>
                        <li><a href="#sobre" class="text-gray-400 hover:text-white transition">Sobre Nós</a></li>
                        <li><a href="#contato" class="text-gray-400 hover:text-white transition">Contato</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition">Política de Privacidade</a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-lg font-semibold mb-4">Newsletter</h3>
                    <p class="text-gray-400 mb-4">Inscreva-se para receber nossas atualizações e ofertas especiais.</p>
                    <form>
                        <div class="flex mb-2">
                            <input type="email" placeholder="Seu email" class="px-4 py-2 w-full rounded-l-lg focus:outline-none text-gray-800">
                            <button type="submit" class="bg-accent hover:bg-yellow-600 text-white px-4 py-2 rounded-r-lg transition duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                </svg>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="border-t border-gray-800 mt-10 pt-6 text-center">
                <p class="text-gray-400">&copy; 2025 MineralTech. Todos os direitos reservados.</p>
            </div>
        </div>
    </footer>
    </body>

</html>
