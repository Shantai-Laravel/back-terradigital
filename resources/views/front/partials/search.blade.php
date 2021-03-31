<section class="banner-home">
    @php
        $dtBanner = Banner('searchBackground', 'desktop');
    @endphp
    <img src="{{ $dtBanner['src'] }}" alt="" />
    <div class="banner-inner">
        <img src="/fronts/img/icons/logo-white-svg.svg" alt="" />
        <div class="search-container">
            <input class="advaced-search" type="text" placeholder="{{ trans('vars.General.hpSearch') }}" />
            <a class="redirect-link" href="https://opac.hasdeu.md/cgi-bin/koha/opac-search.pl/" target="_blank">
            <button>
                <svg
                    viewBox="0 0 17 17"
                    version="1.1"
                    xmlns="http://www.w3.org/2000/svg"
                    xmlns:xlink="http://www.w3.org/1999/xlink"
                    >
                    <g id="Site" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <g
                            class="search-svg header-right-svg"
                            id="Home_Page_Hasdeu-Copy"
                            transform="translate(-1626.000000, -36.000000)"
                            fill="#363636"
                            fill-rule="nonzero"
                            >
                            <g id="Header" transform="translate(1.000000, -5.000000)">
                                <g
                                    id="left-arrow-2-copy-2"
                                    transform="translate(1601.000000, 48.500000) rotate(-90.000000) translate(-1601.000000, -48.500000) translate(1591.000000, 8.000000)"
                                    >
                                    <g id="left-arrow" transform="translate(0.000000, 0.000000)">
                                        <g id="Group-3" transform="translate(0.000000, 0.000000)">
                                            <g
                                                id="search"
                                                transform="translate(9.000000, 73.000000) scale(-1, 1) translate(-9.000000, -73.000000) translate(1.000000, 65.000000)"
                                                >
                                                <path
                                                    d="M11.4351201,10.0629074 L10.7078473,10.0629074 L10.4562607,9.81132075 C11.3527873,8.77302744 11.8924957,7.42367067 11.8924957,5.9462693 C11.8924957,2.66209262 9.23040309,0 5.9462693,0 C2.66213551,0 0,2.66209262 0,5.9462693 C0,9.23044597 2.66209262,11.8925386 5.9462693,11.8925386 C7.42367067,11.8925386 8.77302744,11.3527873 9.81132075,10.4608491 L10.0629074,10.7124357 L10.0629074,11.4351201 L14.6369211,16 L16,14.6369211 L11.4351201,10.0629074 Z M6,10 C3.791125,10 2,8.208875 2,6 C2,3.791125 3.791125,2 6,2 C8.208875,2 10,3.791125 10,6 C10,8.208875 8.208875,10 6,10 Z"
                                                    id="Shape"
                                                    ></path>
                                            </g>
                                        </g>
                                    </g>
                                </g>
                            </g>
                        </g>
                    </g>
                </svg>
            </button>
            </a>
        </div>
        <div class="adv">
            <a class="redirect-link" href="https://opac.hasdeu.md/cgi-bin/koha/opac-search.pl" target="_blank">{{ trans('vars.General.hpSearchAdvanced') }}</a>
        </div>
    </div>
</section>
