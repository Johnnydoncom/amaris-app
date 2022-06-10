<x-app-layout>
    <!-- Page title -->
    <section class="relative pt-14 lg:pb-16">
        <picture class="pointer-events-none absolute inset-0 -z-10 dark:hidden">
            <img src="{{Storage::url('gradient_light.jpg')}}" alt="gradient" class="h-full w-full" />
        </picture>
        <div class="container">
            <!-- Page Title -->
            <div class="mx-auto max-w-2xl py-16 text-center">
                <h1 class="font-display text-jacarta-700 mb-8 text-4xl font-extrabold dark:text-white">About {{config('app.name')}}</h1>
                <p class="dark:text-jacarta-300 text-lg leading-normal">
                    At Amaris.ng, Our major focus is to help bridge the gap in which consumers gain access to products through the use of technology.
                </p>
            </div>
        </div>
    </section>


    <!-- Story -->
    <section class="dark:bg-jacarta-800 relative py-14">
        <picture class="pointer-events-none absolute inset-0 -z-10 dark:hidden">
            <img src="{{Storage::url('gradient_light.jpg')}}" alt="gradient" class="h-full w-full" />
        </picture>

        <div class="container">
            <div class="lg:flex lg:justify-between">
                <!-- Image -->
                <div class="lg:w-[55%]">
                    <div class="relative rounded-l-lg">
                        <img src="{{Storage::url('amaris-3d-mock-up.jpg')}}" alt="" class="rounded-l-full animate-fly top-0 w-full"  />
                    </div>
                </div>

                <!-- Info -->
                <div class="py-20 lg:w-[45%] lg:pl-16">
                    <h2 class="text-jacarta-900 font-display font-extrabold mb-6 text-4xl dark:text-white">
                        Working with your organisation
                    </h2>
                    <div class="dark:text-jacarta-300 mb-10">
                       <p class="mb-4"> We believe that technology has come to change the way and manner of which products and services get to their final consumers.</p>
                        <p class="mb-4">Our main goal is to provide an accessible market place with a well-integrated and precise platform where it is easy for every and anyone to be able to access both physical and digital products seamlessly.</p>
                        <p class="mb-4">We are aware that there are already major players in the industry who are doing a great job. But our main target is to provide ease.</p>
                        <p>With the help of our team of engineers and marketing specialists we have been able to create a solution where anyone can pick up a device, pick up a digital or physical product and would be sure to get it in due time.</p>
                    </div>
                    <div class="flex space-x-4 sm:space-x-10">
                        <div class="flex space-x-4">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24"
                                width="24"
                                height="24"
                                class="fill-accent h-8 w-8 shrink-0"
                            >
                                <path fill="none" d="M0 0h24v24H0z" />
                                <path
                                    d="M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10 4.477 10 10-4.477 10-10 10zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16zm-.997-4L6.76 11.757l1.414-1.414 2.829 2.829 5.656-5.657 1.415 1.414L11.003 16z"
                                />
                            </svg>
                            <div>
                                <span class="font-display text-jacarta-700 block text-xl dark:text-white">11,2k+</span>
                                <span class="dark:text-jacarta-300 text-jacarta-700">Products Sold</span>
                            </div>
                        </div>
                        <div class="flex space-x-4">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24"
                                width="24"
                                height="24"
                                class="fill-accent h-8 w-8 shrink-0"
                            >
                                <path fill="none" d="M0 0h24v24H0z" />
                                <path
                                    d="M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10 4.477 10 10-4.477 10-10 10zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16zm-.997-4L6.76 11.757l1.414-1.414 2.829 2.829 5.656-5.657 1.415 1.414L11.003 16z"
                                />
                            </svg>
                            <div>
                                <span class="font-display text-jacarta-700 block text-xl dark:text-white">99,7%</span>
                                <span class="dark:text-jacarta-300 text-jacarta-700">Satisfaction Rate</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end story -->
</x-app-layout>
