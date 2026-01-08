<!-- COMPLETE HTML FORM - Replace your existing form with this -->

<form class="property-form" id="heroContactForm" action="<?php echo admin_url('admin-ajax.php'); ?>" method="post"
    enctype="multipart/form-data" novalidate>

    <!-- Step 1: Personal & Location Details -->
    <div class="form-step" data-step="1" style="display: block;">
        <div class="form-row-1">
            <div class="form-group">
                <input type="text" name="full_name" placeholder="Full Name" required>
                <div class="validation-error" style="color:red;display:none;font-size:12px;"></div>
            </div>
            <div class="form-group">
                <input type="tel" name="phone" placeholder="Phone Number" required>
                <div class="validation-error" style="color:red;display:none;font-size:12px;"></div>
            </div>
        </div>

        <div class="form-row-2">
            <div class="form-group">
                <input type="email" name="email" placeholder="Email Address" required>
                <div class="validation-error" style="color:red;display:none;font-size:12px;"></div>
            </div>
            <div class="form-group">
                <select name="emirate" class="select_box" required>
                    <option value="" selected disabled>Emirate</option>
                    <option value="dubai">Dubai</option>
                    <option value="abu-dhabi">Abu Dhabi</option>
                    <option value="sharjah">Sharjah</option>
                    <option value="ajman">Ajman</option>
                </select>
                <div class="validation-error" style="color:red;display:none;font-size:12px;"></div>
            </div>
        </div>

        <div class="form-row-3">
            <div class="form-group">
                <select name="community_area" id="community-area" required>
                    <option value="" selected disabled>Select an Emirate first</option>
                </select>
                <div class="validation-error" style="color:red;display:none;font-size:12px;"></div>
            </div>

            <div class="form-group">
                <button type="button" class="btn-primary footer-cta-btn submit-button next-step-btn w_100">
                    Next
                    <svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M4.88452 0.880798L9.19988 5.00001L4.88452 9.11922" stroke="white"
                            stroke-width="1.28571" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M9.2 4.99994L0.800049 4.99994" stroke="white" stroke-width="1.28571"
                            stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Step 2: Property Details -->
    <div class="form-step" data-step="2" style="display: none;">
        <div class="form-row-1">
            <div class="form-group">
                <select name="property_type" required>
                    <option value="" selected disabled>Property Type</option>
                    <option value="apartment">Apartment</option>
                    <option value="villa">Villa</option>
                    <option value="townhouse">Townhouse</option>
                    <option value="penthouse">Land</option>
                    <option value="commercial">Commercial - Offices or Industrial</option>
                </select>
                <div class="validation-error" style="color:red;display:none;font-size:12px;"></div>
            </div>
            <div class="form-group">
                <select name="bedrooms" required>
                    <option value="" selected disabled>Number Of Bedrooms</option>
                    <option value="studio">Studio</option>
                    <option value="1">1 Bedroom</option>
                    <option value="2">2 Bedrooms</option>
                    <option value="3">3 Bedrooms</option>
                    <option value="4">4 Bedrooms</option>
                    <option value="5">5 Bedrooms</option>
                    <option value="6plus">6+ Bedrooms</option>
                </select>
                <div class="validation-error" style="color:red;display:none;font-size:12px;"></div>
            </div>
        </div>

        <div class="form-row-2">
            <div class="form-group">
                <input type="text" name="bua" placeholder="BUA (Built-Up Area in Sq.Ft)" required>
                <div class="validation-error" style="color:red;display:none;font-size:12px;"></div>
            </div>
            <div class="form-group">
                <select name="occupancy_status" required>
                    <option value="" selected disabled>Occupancy Status</option>
                    <option value="rented">Rented </option>
                    <option value="vacant">Vacant</option>
                    <option value="vacant-transfer">Vacant on transfer</option>
                </select>
                <div class="validation-error" style="color:red;display:none;font-size:12px;"></div>
            </div>
        </div>

        <div class="form-row-1">
            <div class="form-group">
                <input type="text" name="expected_price" placeholder="Expected Selling Price (Optional)">
                <!-- Optional so skip errors -->
            </div>
        </div>

        <div class="form-row-3">
            <div class="submit-group" style="display: flex; gap: 10px;">
                <button type="button" class="btn-primary footer-cta-btn prev-step-btn">
                    <svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg"
                        style="transform: rotate(180deg);">
                        <path d="M4.88452 0.880798L9.19988 5.00001L4.88452 9.11922" stroke="white"
                            stroke-width="1.28571" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M9.2 4.99994L0.800049 4.99994" stroke="white" stroke-width="1.28571"
                            stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    Back
                </button>
                <button type="button" class="btn-primary footer-cta-btn submit-button next-step-btn">
                    Next
                    <svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M4.88452 0.880798L9.19988 5.00001L4.88452 9.11922" stroke="white"
                            stroke-width="1.28571" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M9.2 4.99994L0.800049 4.99994" stroke="white" stroke-width="1.28571"
                            stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Step 3: Sale Details & Upload -->
    <div class="form-step" data-step="3" style="display: none;">
        <div class="form-row-1">
            <div class="form-group">
                <select name="property_ready" id="property_ready_select" required>
                    <option value="" selected disabled>Is The Property Ready Or Off-Plan?</option>
                    <option value="ready">Ready / Completed</option>
                    <option value="off-plan">Off-plan (Under Construction)</option>
                </select>
                <div class="validation-error" style="color:red;display:none;font-size:12px;"></div>
            </div>

            <div class="form-group">
                <select name="reason_selling" required>
                    <option value="financial-difficulty">Financial difficulty</option>
                    <option value="needquick-cash">Need quick cash </option>
                    <option value="relocating">Relocating</option>
                    <option value="upgrading">Upgrading / downsizing</option>
                    <option value="behind-on-payments">Behind on payments</option>
                    <option value="other">Other</option>
                </select>
                <div class="validation-error" style="color:red;display:none;font-size:12px;"></div>
            </div>
        </div>

        <!-- Show ONLY if "Off-plan" is selected -->
        <div class="row-display">
            <div id="offplan-details-group" style="display: none;">
                <div class="form-group">
                    <input type="text" name="developer_name" placeholder="Developer Name">
                </div>
                <div class="form-group">
                    <input type="text" name="project_name" placeholder="Project Name">
                </div>
                <div class="form-group">
                    <input type="month" name="completion_date" placeholder="Completion Date (Month/Year)">
                </div>
                <div class="form-group">
                    <select name="payment_plan_remaining" id="payment_plan_remaining_select">
                        <option value="" selected disabled>Payment Plan Remaining</option>
                        <option value="10-20">10–20%</option>
                        <option value="20-40">20–40%</option>
                        <option value="40-60">40–60%</option>
                        <option value="60-90">60–90%</option>
                        <option value="fully-paid">Fully paid</option>
                    </select>
                </div>
            </div>

            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    var propertyReadySelect = document.getElementById('property_ready_select');
                    var offplanDetailsGroup = document.getElementById('offplan-details-group');

                    function toggleReadyOffplanDetails() {
                        var value = propertyReadySelect.value;
                        if (value === 'off-plan') {
                            offplanDetailsGroup.style.display = '';
                        } else {
                            // Hide off-plan details for "ready" or empty selection
                            offplanDetailsGroup.style.display = 'none';
                        }
                    }

                    propertyReadySelect.addEventListener('change', toggleReadyOffplanDetails);

                    // Set initial display based on pre-filled value (if any)
                    toggleReadyOffplanDetails();
                });
            </script>
        </div>
        <div class="form-row-2">
            <div class="form-group">
                <select name="timeline" required>
                    <option value="" selected disabled>Timeline</option>
                    <option value="immediate">Immediate (Within 1 Month)</option>
                    <option value="asap">ASAP (7 days or less)</option>
                    <option value="1-4-weeks">1–4 weeks</option>
                    <option value="1-3-months">1–3 months</option>
                    <option value="exploring">Just exploring options</option>
                </select>
                <div class="validation-error" style="color:red;display:none;font-size:12px;"></div>
            </div>

            <div class="upload-group">
                <input type="file" name="property_images[]" id="property_images" multiple accept="image/*">
                <div class="upload-button">
                    <span>Upload Images</span>
                    <span class="upload-icon">
                        <svg width="17" height="16" viewBox="0 0 17 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M8.31343 1V15.0136M1.30664 8.00679H15.3202" stroke="white" stroke-width="1.5"
                                stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </span>
                </div>
                <script>
                    // Show/hide bedrooms select based on property type
                    document.addEventListener('DOMContentLoaded', function () {
                        var propertyTypeSelect = document.querySelector('select[name="property_type"]');
                        var bedroomsSelectGroup = null;
                        // Find the parent .form-group of the Bedrooms select
                        document.querySelectorAll('select[name="bedrooms"]').forEach(function (select) {
                            if (!bedroomsSelectGroup) {
                                bedroomsSelectGroup = select.closest('.form-group');
                            }
                        });

                        function toggleBedrooms() {
                            const value = propertyTypeSelect ? propertyTypeSelect.value : '';
                            if (bedroomsSelectGroup) {
                                const bedroomsSelect = bedroomsSelectGroup.querySelector('select[name="bedrooms"]');
                                if (value === 'apartment' || value === 'villa' || value === 'townhouse') {
                                    bedroomsSelectGroup.style.display = '';
                                    // Restore required attribute if it was saved
                                    if (bedroomsSelect && bedroomsSelect.hasAttribute('data-was-required')) {
                                        bedroomsSelect.setAttribute('required', 'required');
                                        bedroomsSelect.removeAttribute('data-was-required');
                                    }
                                    // Clear any validation errors
                                    bedroomsSelect.style.borderColor = '';
                                    const errorDiv = bedroomsSelectGroup.querySelector('.validation-error');
                                    if (errorDiv) {
                                        errorDiv.innerText = '';
                                        errorDiv.style.display = 'none';
                                    }
                                } else {
                                    bedroomsSelectGroup.style.display = 'none';
                                    // Remove required attribute when hidden
                                    if (bedroomsSelect && bedroomsSelect.hasAttribute('required')) {
                                        bedroomsSelect.setAttribute('data-was-required', 'true');
                                        bedroomsSelect.removeAttribute('required');
                                    }
                                    // Clear validation errors and reset selection when hidden
                                    if (bedroomsSelect) {
                                        bedroomsSelect.value = '';
                                        bedroomsSelect.style.borderColor = '';
                                        const errorDiv = bedroomsSelectGroup.querySelector('.validation-error');
                                        if (errorDiv) {
                                            errorDiv.innerText = '';
                                            errorDiv.style.display = 'none';
                                        }
                                    }
                                }
                            }
                        }

                        if (propertyTypeSelect && bedroomsSelectGroup) {
                            // Initial check
                            toggleBedrooms();
                            // On change
                            propertyTypeSelect.addEventListener('change', toggleBedrooms);
                        }
                    });
                </script>
            </div>
        </div>

        <!-- <div class="form-row-3">
           
        </div> -->

        <div class="form-row-3">
            <div class="submit-group" style="display: flex; gap: 10px;">
                <button type="button" class="btn-primary footer-cta-btn prev-step-btn">
                    <svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg"
                        style="transform: rotate(180deg);">
                        <path d="M4.88452 0.880798L9.19988 5.00001L4.88452 9.11922" stroke="white"
                            stroke-width="1.28571" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M9.2 4.99994L0.800049 4.99994" stroke="white" stroke-width="1.28571"
                            stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    Back
                </button>
                <button type="submit" class="btn-primary footer-cta-btn submit-button">
                    Submit
                    <svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M4.88452 0.880798L9.19988 5.00001L4.88452 9.11922" stroke="white"
                            stroke-width="1.28571" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M9.2 4.99994L0.800049 4.99994" stroke="white" stroke-width="1.28571"
                            stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Step 4: Success Message -->
    <div class="form-step success-step" data-step="4" style="display: none;">
        <div style="text-align: center; padding: 40px 20px;">
            <div style="margin-bottom: 10px;">
                <svg width="80" height="80" viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg"
                    style="display: inline-block;">
                    <circle cx="40" cy="40" r="40" fill="#4CAF50" />
                    <path d="M25 40L35 50L55 30" stroke="white" stroke-width="4" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
            </div>
            <h2 style="font-size: 28px; color: #fff; margin-bottom: 10px;">Thank You!</h2>
            <p style="font-size: 16px; color: #fff; line-height: 1.6; margin-bottom: 15px;">
                Your property submission has been received successfully.
            </p>
            <p style="font-size: 16px; color: #fff; line-height: 1.6; margin-bottom: 10px;">
                Our team will review your information and contact you shortly.
            </p>
            <button type="button" class="btn-primary footer-cta-btn" onclick="location.reload();"
                style="margin-top: 10px;">
                Submit Another Property
                <svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M4.88452 0.880798L9.19988 5.00001L4.88452 9.11922" stroke="white" stroke-width="1.28571"
                        stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M9.2 4.99994L0.800049 4.99994" stroke="white" stroke-width="1.28571" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
            </button>
        </div>
    </div>
</form>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.getElementById('heroContactForm');
        if (!form) {
            return;
        }

        // Dynamic Community/Area Filter with Auto-suggest
        (function () {
            const communities = {
                'Dubai': [
                    'Downtown Dubai',
                    'Dubai Marina',
                    'JBR (Jumeirah Beach Residence)',
                    'Business Bay',
                    'Palm Jumeirah',
                    'Arabian Ranches',
                    'Arabian Ranches 2',
                    'Dubai Hills Estate',
                    'Jumeirah Village Circle (JVC)',
                    'Jumeirah Village Triangle (JVT)',
                    'Dubai Sports City',
                    'Motor City',
                    'Discovery Gardens',
                    'International City',
                    'Deira',
                    'Bur Dubai',
                    'Al Barsha',
                    'Jumeirah Lakes Towers (JLT)',
                    'Dubai Silicon Oasis',
                    'Mirdif',
                    'Al Furjan',
                    'Damac Hills',
                    'Dubai Land',
                    'Nad Al Sheba',
                    'Al Quoz',
                    'Jumeirah',
                    'Umm Suqeim',
                    'The Greens',
                    'The Views',
                    'Emirates Hills',
                    'Meadows',
                    'Springs',
                    'Lakes',
                    'Dubai Production City (IMPZ)',
                    'Studio City',
                    'Sports City',
                    'Al Barari',
                    'City Walk',
                    'DIFC',
                    'Bluewaters Island',
                    'Dubai Creek Harbour',
                    'Al Satwa'
                ],
                'Abu Dhabi': [
                    'Al Reem Island',
                    'Yas Island',
                    'Saadiyat Island',
                    'Al Reef',
                    'Al Raha Beach',
                    'Khalifa City',
                    'Masdar City',
                    'Al Ghadeer',
                    'Al Shamkha',
                    'Mohammed Bin Zayed City',
                    'Mussafah',
                    'Tourist Club Area',
                    'Corniche Area',
                    'Al Bateen',
                    'Al Khalidiyah',
                    'Al Wahda',
                    'Al Markaziyah',
                    'Al Nahyan',
                    'Al Mushrif',
                    'Hydra Village',
                    'Marina Village',
                    'Golf Gardens',
                    'Al Bandar',
                    'Water\'s Edge',
                    'Mangrove Place'
                ],
                'Sharjah': [
                    'Al Majaz',
                    'Al Nahda',
                    'Muwailih',
                    'Al Khan',
                    'Al Qasimia',
                    'University City',
                    'Al Taawun',
                    'Abu Shagara',
                    'Al Mamzar',
                    'Rolla',
                    'King Faisal Street',
                    'Al Qulayaa',
                    'Al Dhaid',
                    'Al Ghubaiba',
                    'Industrial Area',
                    'Maysaloon',
                    'Halwan Suburb',
                    'Al Sharq',
                    'Al Mujarrah',
                    'Al Jazzat',
                    'Samnan',
                    'Tilal City',
                    'Aljada'
                ],
                'Ajman': [
                    'Al Nuaimiya',
                    'Al Rashidiya',
                    'Al Jurf',
                    'Al Rawda',
                    'Al Zahra',
                    'Al Bustan',
                    'Al Mowaihat',
                    'Emirates City',
                    'Ajman Corniche',
                    'Ajman Downtown',
                    'Al Yasmeen',
                    'Ajman Uptown',
                    'Garden City',
                    'Al Helio',
                    'Al Hamidiya',
                    'Al Sawan',
                    'Ajman Industrial Area'
                ]
            };

            const emirateMap = {
                'dubai': 'Dubai',
                'abu-dhabi': 'Abu Dhabi',
                'sharjah': 'Sharjah',
                'ajman': 'Ajman'
            };

            const emirateSelect = form.querySelector('select[name="emirate"]');
            const communitySelect = document.getElementById('community-area');

            if (emirateSelect && communitySelect) {
                // Function to initialize or reinitialize Choices.js for community select
                function initCommunityChoices() {
                    // Check if Choices.js is available
                    if (typeof Choices === 'undefined') {
                        return;
                    }

                    // Get the native select element (might be wrapped by Choices.js)
                    var nativeSelect = communitySelect;
                    var choicesContainer = null;
                    if (communitySelect.closest('.choices')) {
                        choicesContainer = communitySelect.closest('.choices');
                        nativeSelect = choicesContainer.querySelector('select');
                    }

                    if (!nativeSelect) return;

                    // Destroy existing Choices instance if any
                    try {
                        var existingInstance = Choices.getInstance(nativeSelect);
                        if (existingInstance) {
                            existingInstance.destroy();
                        }
                    } catch (e) {
                        // Ignore errors
                    }

                    // Remove disabled attribute and classes before initializing
                    nativeSelect.disabled = false;
                    nativeSelect.removeAttribute('disabled');
                    if (choicesContainer) {
                        choicesContainer.classList.remove('is-disabled');
                    }

                    // Initialize Choices.js regardless of disabled state (to maintain styling)
                    try {
                        var placeholderOption = nativeSelect.querySelector('option[selected][disabled]') ||
                            nativeSelect.querySelector('option[disabled]') ||
                            nativeSelect.querySelector('option[value=""]');
                        var placeholder = placeholderOption
                            ? placeholderOption.text
                            : 'Select Community/Area';

                        var choices = new Choices(nativeSelect, {
                            placeholder: true,
                            placeholderValue: placeholder,
                            searchEnabled: false,
                            itemSelectText: '',
                            shouldSort: false,
                            removeItemButton: false
                        });

                        // If select should be disabled, disable the Choices.js instance
                        if (communitySelect.disabled || nativeSelect.disabled) {
                            choices.disable();
                        } else {
                            // Explicitly enable it
                            choices.enable();
                            // Remove any disabled classes that might have been added
                            var container = nativeSelect.closest('.choices');
                            if (container) {
                                container.classList.remove('is-disabled');
                                // Also remove from inner element
                                var inner = container.querySelector('.choices__inner');
                                if (inner) {
                                    inner.classList.remove('is-disabled');
                                }
                            }
                        }
                    } catch (e) {
                        console.error('Choices.js init error for community select:', e);
                    }
                }

                // Initialize Choices.js immediately (even if disabled) to get the styling
                setTimeout(function () {
                    initCommunityChoices();
                }, 200);

                function updateCommunities(emirate) {
                    // Get the native select element (might be wrapped by Choices.js)
                    var nativeSelect = communitySelect;
                    var choicesInstance = null;

                    if (communitySelect.closest('.choices')) {
                        nativeSelect = communitySelect.closest('.choices').querySelector('select');
                    }

                    if (!nativeSelect) {
                        nativeSelect = communitySelect;
                    }

                    // Get existing Choices instance if it exists
                    try {
                        choicesInstance = Choices.getInstance(nativeSelect);
                    } catch (e) {
                        // Ignore
                    }

                    // Ensure both selects are enabled before updating
                    communitySelect.disabled = false;
                    communitySelect.removeAttribute('disabled');
                    nativeSelect.disabled = false;
                    nativeSelect.removeAttribute('disabled');

                    // Get communities for selected emirate
                    const selectedCommunities = communities[emirate] || [];

                    // Always destroy and recreate to ensure clean state and proper option rendering
                    if (choicesInstance) {
                        try {
                            choicesInstance.destroy();
                        } catch (e) {
                            // Ignore errors
                        }
                    }

                    // Remove Choices.js wrapper if it still exists after destroy
                    var container = nativeSelect.closest('.choices');
                    if (container && container.parentNode) {
                        // Unwrap the select from Choices.js container
                        container.parentNode.insertBefore(nativeSelect, container);
                        container.remove();
                    }

                    // Clear existing options and add new ones to native select
                    nativeSelect.innerHTML = '<option value="" selected disabled>Select Community/Area</option>';

                    // Add new options to native select
                    selectedCommunities.forEach(function (community) {
                        const option = document.createElement('option');
                        option.value = community;
                        option.textContent = community;
                        nativeSelect.appendChild(option);
                    });

                    // Verify options were added (for debugging)
                    console.log('Native select options count:', nativeSelect.options.length);
                    console.log('Native select HTML:', nativeSelect.innerHTML.substring(0, 200));

                    // Wait a bit to ensure DOM is updated, then reinitialize Choices.js
                    setTimeout(function () {
                        // Ensure select is enabled
                        if (nativeSelect) {
                            nativeSelect.disabled = false;
                            nativeSelect.removeAttribute('disabled');
                        }
                        if (communitySelect) {
                            communitySelect.disabled = false;
                            communitySelect.removeAttribute('disabled');
                        }

                        // Make absolutely sure native select is unwrapped from any Choices.js container
                        var existingContainer = nativeSelect.closest('.choices');
                        if (existingContainer && existingContainer.parentNode) {
                            // Unwrap the select
                            existingContainer.parentNode.insertBefore(nativeSelect, existingContainer);
                            existingContainer.remove();
                        }

                        // Verify options are still there before initializing
                        console.log('Before init - Options count:', nativeSelect.options.length);
                        if (nativeSelect.options.length < 2) {
                            console.warn('Options missing! Re-adding...');
                            // Re-add options if they're missing
                            nativeSelect.innerHTML = '<option value="" selected disabled>Select Community/Area</option>';
                            selectedCommunities.forEach(function (community) {
                                const option = document.createElement('option');
                                option.value = community;
                                option.textContent = community;
                                nativeSelect.appendChild(option);
                            });
                        }

                        // Initialize Choices.js directly - it will read all options from native select
                        if (typeof Choices !== 'undefined') {
                            try {
                                // Destroy any existing instance first
                                try {
                                    var existing = Choices.getInstance(nativeSelect);
                                    if (existing) {
                                        existing.destroy();
                                        // Wait a bit for destroy to complete
                                        setTimeout(function () {
                                            initializeChoices();
                                        }, 50);
                                        return;
                                    }
                                } catch (e) {
                                    // No existing instance, continue
                                }

                                initializeChoices();

                                function initializeChoices() {
                                    var placeholderOption = nativeSelect.querySelector('option[selected][disabled]') ||
                                        nativeSelect.querySelector('option[disabled]') ||
                                        nativeSelect.querySelector('option[value=""]');
                                    var placeholder = placeholderOption
                                        ? placeholderOption.text
                                        : 'Select Community/Area';

                                    console.log('Initializing Choices.js with', nativeSelect.options.length, 'options');

                                    var choices = new Choices(nativeSelect, {
                                        placeholder: true,
                                        placeholderValue: placeholder,
                                        searchEnabled: false,
                                        itemSelectText: '',
                                        shouldSort: false,
                                        removeItemButton: false
                                    });

                                    // Enable the instance
                                    choices.enable();

                                    // Remove disabled classes
                                    var newContainer = nativeSelect.closest('.choices');
                                    if (newContainer) {
                                        newContainer.classList.remove('is-disabled');
                                    }

                                    // Reset to placeholder
                                    choices.setChoiceByValue('');

                                    console.log('Choices.js initialized successfully. Options in dropdown:', choices._currentState.choices ? choices._currentState.choices.length : 'unknown');
                                }
                            } catch (e) {
                                console.error('Error initializing Choices.js:', e);
                            }
                        }
                    }, 200);
                }

                // Disable community select initially if no emirate selected
                if (!emirateSelect.value || emirateSelect.value === '') {
                    communitySelect.disabled = true;
                    communitySelect.innerHTML = '<option value="" selected disabled>Select an Emirate first</option>';
                } else {
                    // If emirate is already selected, update communities
                    const emirateName = emirateMap[emirateSelect.value];
                    if (emirateName) {
                        communitySelect.disabled = false;
                        updateCommunities(emirateName);
                    }
                }

                // Listen for emirate changes
                emirateSelect.addEventListener('change', function () {
                    const selectedEmirate = this.value;
                    const emirateName = emirateMap[selectedEmirate];

                    if (selectedEmirate && selectedEmirate !== '' && emirateName) {
                        // Enable the native select FIRST (before any Choices.js operations)
                        communitySelect.disabled = false;

                        // Get native select (might be wrapped by Choices.js)
                        var nativeSelect = communitySelect;
                        if (communitySelect.closest('.choices')) {
                            nativeSelect = communitySelect.closest('.choices').querySelector('select');
                        }

                        // Enable native select if found
                        if (nativeSelect) {
                            nativeSelect.disabled = false;

                            // Destroy existing Choices instance
                            try {
                                var existingInstance = Choices.getInstance(nativeSelect);
                                if (existingInstance) {
                                    existingInstance.destroy();
                                }
                            } catch (e) {
                                // Ignore errors
                            }
                        }

                        // Update communities (this will reinitialize Choices.js)
                        updateCommunities(emirateName);
                    } else {
                        // Get native select before disabling
                        var nativeSelect = communitySelect;
                        if (communitySelect.closest('.choices')) {
                            nativeSelect = communitySelect.closest('.choices').querySelector('select');
                        }

                        // Disable the native select
                        communitySelect.disabled = true;
                        if (nativeSelect) {
                            nativeSelect.disabled = true;
                        }
                        communitySelect.value = '';
                        communitySelect.innerHTML = '<option value="" selected disabled>Select an Emirate first</option>';

                        // Disable Choices.js instance but keep it initialized for styling
                        if (nativeSelect) {
                            try {
                                var existingInstance = Choices.getInstance(nativeSelect);
                                if (existingInstance) {
                                    existingInstance.disable();
                                }
                            } catch (e) {
                                // Ignore errors
                            }
                        }
                    }
                });

                // Initialize on page load if emirate is already selected
                if (emirateSelect.value && emirateSelect.value !== '') {
                    const emirateName = emirateMap[emirateSelect.value];
                    if (emirateName) {
                        communitySelect.disabled = false;
                        updateCommunities(emirateName);
                    }
                }
            }
        })();

        const steps = form.querySelectorAll('.form-step');
        let currentStep = 1;

        function clearAllErrors(step) {
            // Remove all validation-error divs (including any duplicates)
            step.querySelectorAll('.validation-error').forEach(div => {
                div.remove();
            });
            // Also remove any field-error divs that might have been added by other scripts
            step.querySelectorAll('.field-error').forEach(div => {
                div.remove();
            });
            step.querySelectorAll('input,select,textarea').forEach(el => {
                el.style.borderColor = '';
                el.classList.remove('error-border');
            });
        }

        function validateStep(step) {
            let isValid = true;
            // Only validate fields in visible steps
            if (step.style.display === 'none') {
                return true; // Skip validation for hidden steps
            }

            // Get all required fields in this step
            const inputs = step.querySelectorAll('input[required], select[required], textarea[required]');

            // Clear all previous errors first
            clearAllErrors(step);

            // Validate ALL fields - don't stop at first error

            // Get property type to determine if bedrooms should be validated
            const propertyTypeSelect = form.querySelector('select[name="property_type"]');
            const propertyType = propertyTypeSelect ? propertyTypeSelect.value : '';
            const bedroomsNotRequired = propertyType === 'penthouse' || propertyType === 'commercial';

            inputs.forEach(input => {
                if (input.type === 'file') return;

                // Skip bedrooms validation if property type doesn't require it
                if (input.name === 'bedrooms' && bedroomsNotRequired) {
                    return; // Skip bedrooms validation for Land/Commercial
                }

                // Skip validation for hidden fields (check if field or its parent is hidden)
                let group = input.parentElement;
                // Check multiple ways to determine if field is hidden
                const computedStyle = window.getComputedStyle(group);
                const isFieldHidden = group.style.display === 'none' ||
                    computedStyle.display === 'none' ||
                    computedStyle.visibility === 'hidden' ||
                    input.offsetParent === null;

                if (isFieldHidden) {
                    return; // Skip validation for hidden fields
                }

                // Remove any existing error divs first to prevent duplicates
                group.querySelectorAll('.validation-error, .field-error').forEach(div => {
                    div.remove();
                });

                // Create a single error div
                let errorDiv = document.createElement('div');
                errorDiv.className = 'validation-error';
                errorDiv.style.color = 'red';
                errorDiv.style.display = 'none';
                errorDiv.style.fontSize = '12px';
                group.appendChild(errorDiv);

                let fieldValue = input.value ? input.value.trim() : '';
                let fieldError = '';

                if (input.tagName === 'SELECT') {
                    // Check if select has a valid value (not empty, not disabled, and not the placeholder)
                    // Note: HTML select elements return empty string "", not null when empty
                    const selectedIndex = input.selectedIndex;
                    const selectedOption = input.options[selectedIndex];
                    const selectedValue = input.value;

                    // Validate select field - MUST check for disabled option first (placeholder)
                    // This is the most common case when user hasn't selected anything
                    if (selectedOption && selectedOption.disabled === true) {
                        isValid = false;
                        fieldError = 'Please fill out this field.';
                    }
                    // Check if no option is selected or index is invalid
                    else if (selectedIndex < 0 || selectedIndex >= input.options.length) {
                        isValid = false;
                        fieldError = 'Please fill out this field.';
                    }
                    // Check if value is empty string (select elements return "" not null)
                    else if (selectedValue === '' || selectedValue === null || selectedValue === undefined || !selectedValue) {
                        isValid = false;
                        fieldError = 'Please fill out this field.';
                    }
                } else if (input.type === 'email') {
                    // Check if value is null - show validation
                    if (fieldValue === null) {
                        isValid = false;
                        fieldError = 'Email address is required.';
                    }
                    // Check if value is empty or undefined
                    else if (fieldValue === undefined || !fieldValue) {
                        isValid = false;
                        fieldError = 'Email address is required.';
                    } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(fieldValue)) {
                        isValid = false;
                        fieldError = 'Please enter a valid email address.';
                    }
                } else if (input.type === 'tel') {
                    // Check if value is null - show validation
                    if (fieldValue === null) {
                        isValid = false;
                        fieldError = 'Phone number is required.';
                    }
                    // Check if value is empty or undefined
                    else if (fieldValue === undefined || !fieldValue) {
                        isValid = false;
                        fieldError = 'Phone number is required.';
                    } else if (!/^\+?[0-9\s\-]{6,}$/.test(fieldValue)) {
                        isValid = false;
                        fieldError = 'Please enter a valid phone number.';
                    }
                } else {
                    // Check if value is null - show validation
                    if (fieldValue === null) {
                        isValid = false;
                        fieldError = 'This field is required.';
                    }
                    // Check if value is empty or undefined
                    else if (fieldValue === undefined || !fieldValue) {
                        isValid = false;
                        fieldError = 'This field is required.';
                    }
                }

                if (fieldError) {
                    // Show error - add red border and display error message
                    input.style.borderColor = 'red';
                    input.style.borderWidth = '2px';
                    errorDiv.innerText = fieldError;
                    errorDiv.style.display = 'block';
                    errorDiv.style.visibility = 'visible';
                } else {
                    // Clear error styling
                    input.style.borderColor = '';
                    input.style.borderWidth = '';
                    errorDiv.innerText = '';
                    errorDiv.style.display = 'none';
                }
            });

            return isValid;
        }

        function showStep(stepNumber) {
            steps.forEach(step => step.style.display = 'none');
            if (steps[stepNumber - 1]) {
                steps[stepNumber - 1].style.display = 'block';
            }
            // Removed scroll to prevent upward movement when clicking next
            // Update required attributes after showing step
            updateRequiredAttributes();
        }

        // Function to update required attributes based on visibility
        function updateRequiredAttributes() {
            steps.forEach((step) => {
                const isStepVisible = step.style.display !== 'none';
                const requiredFields = step.querySelectorAll('[required]');
                requiredFields.forEach(field => {
                    // Check if field is actually visible (not just the step)
                    const group = field.closest('.form-group');
                    const isFieldVisible = isStepVisible &&
                        group &&
                        group.style.display !== 'none' &&
                        window.getComputedStyle(group).display !== 'none';

                    if (isFieldVisible) {
                        // Restore required if it was there before
                        if (field.hasAttribute('data-was-required')) {
                            field.setAttribute('required', 'required');
                            field.removeAttribute('data-was-required');
                        }
                    } else {
                        // Save and remove required from hidden fields
                        if (field.hasAttribute('required') && !field.hasAttribute('data-was-required')) {
                            field.setAttribute('data-was-required', 'true');
                            field.removeAttribute('required');
                        }
                    }
                });
            });
        }

        document.querySelectorAll('.next-step-btn').forEach(btn => {
            btn.addEventListener('click', function (e) {
                e.preventDefault();
                e.stopPropagation();
                e.stopImmediatePropagation();

                const currentStepElement = form.querySelector(`.form-step[data-step="${currentStep}"]`);
                if (!currentStepElement) {
                    return false;
                }

                // Validate current step - this will show errors for ALL invalid fields immediately
                const stepIsValid = validateStep(currentStepElement);

                // If validation fails, show errors and prevent step progression
                if (!stepIsValid) {
                    // Errors are already displayed for all invalid fields by validateStep()
                    // Scroll to first error in current step for better UX
                    const firstError = currentStepElement.querySelector('input[style*="border-color: red"], select[style*="border-color: red"]');
                    if (firstError) {
                        window.scrollTo({ top: firstError.offsetTop - 100, behavior: 'smooth' });
                    }
                    return false; // Prevent any further action
                }

                // Only proceed to next step if validation passes
                if (currentStep < 3) {
                    currentStep++;
                    showStep(currentStep);
                }

                return false;
            });
        });

        document.querySelectorAll('.prev-step-btn').forEach(btn => {
            btn.addEventListener('click', function (e) {
                e.preventDefault();
                if (currentStep > 1) {
                    currentStep--;
                    showStep(currentStep);
                }
            });
        });

        // Prevent browser's native validation popup completely
        form.setAttribute('novalidate', 'novalidate');

        // Initial update of required attributes
        updateRequiredAttributes();

        // Override any checkValidity that might trigger popups
        if (form.checkValidity) {
            form.checkValidity = function () {
                return true; // Always return true to prevent browser popup
            };
        }

        // Also override reportValidity which shows the popup
        if (form.reportValidity) {
            form.reportValidity = function () {
                return true; // Prevent browser popup
            };
        }

        // Only Step 3's button is type="submit"; the rest are type="button"
        form.addEventListener('submit', function (e) {
            // BEGIN SUBMISSION LOGIC REWRITE
            e.preventDefault();
            e.stopPropagation();
            e.stopImmediatePropagation();

            // Clear all previous errors before submission (remove duplicates)
            form.querySelectorAll('.validation-error, .field-error').forEach(div => {
                div.remove();
            });
            form.querySelectorAll('input, select, textarea').forEach(el => {
                el.style.borderColor = '';
                el.classList.remove('error-border');
            });

            // Remove any previous global error
            let globalErr = document.getElementById('form-global-error');
            if (globalErr) {
                globalErr.remove();
            }

            // Validate all steps before submit
            let allStepsValid = true;
            let firstInvalidStep = null;
            for (let i = 1; i <= 3; i++) {
                const stepElement = form.querySelector(`.form-step[data-step="${i}"]`);
                if (stepElement && !validateStep(stepElement)) {
                    allStepsValid = false;
                    if (!firstInvalidStep) {
                        firstInvalidStep = i;
                    }
                }
            }

            if (!allStepsValid) {
                // Show the first step with errors
                if (firstInvalidStep && firstInvalidStep !== currentStep) {
                    currentStep = firstInvalidStep;
                    showStep(currentStep);
                }
                // Scroll to first error
                const firstError = form.querySelector('input[style*="border-color: red"], select[style*="border-color: red"]');
                if (firstError) {
                    window.scrollTo({ top: firstError.offsetTop - 100, behavior: 'smooth' });
                }
                return false;
            }

            const formData = new FormData(form);
            formData.append('action', 'handle_property_form_submission');

            const submitBtn = form.querySelector('button[type="submit"]');
            if (!submitBtn) return false;

            const originalHtml = submitBtn.innerHTML;
            submitBtn.disabled = true;
            submitBtn.innerHTML = 'Submitting...';

            const ajaxUrl = form.getAttribute('action') || window.location.origin + '/wp-admin/admin-ajax.php';

            fetch(ajaxUrl, {
                method: 'POST',
                body: formData,
                credentials: 'same-origin'
            })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.text().then(text => {
                        try {
                            return JSON.parse(text);
                        } catch (e) {
                            console.error('Failed to parse JSON:', text);
                            throw new Error("Invalid response from server");
                        }
                    });
                })
                .then(data => {
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = originalHtml;

                    // Clear all previous errors (remove duplicates)
                    form.querySelectorAll('.validation-error, .field-error').forEach(div => {
                        div.remove();
                    });
                    form.querySelectorAll('input, select, textarea').forEach(el => {
                        el.style.borderColor = '';
                        el.classList.remove('error-border');
                    });

                    if (typeof data === "object" && data.success) {
                        currentStep = 4;
                        showStep(currentStep);
                        // Removed scroll to prevent upward movement
                    } else if (data && data.type === 'validation' && data.errors) {
                        // Handle field-specific validation errors
                        Object.keys(data.errors).forEach(fieldName => {
                            const field = form.querySelector(`[name="${fieldName}"]`);
                            if (field) {
                                field.style.borderColor = 'red';
                                const group = field.parentElement;
                                // Remove any existing error divs first
                                group.querySelectorAll('.validation-error, .field-error').forEach(div => {
                                    div.remove();
                                });
                                // Create a single error div
                                const errorDiv = document.createElement('div');
                                errorDiv.className = 'validation-error';
                                errorDiv.style.color = 'red';
                                errorDiv.style.display = 'block';
                                errorDiv.style.fontSize = '12px';
                                errorDiv.innerText = data.errors[fieldName];
                                group.appendChild(errorDiv);
                            }
                        });

                        // Scroll to first error
                        const firstError = form.querySelector('input[style*="border-color: red"], select[style*="border-color: red"]');
                        if (firstError) {
                            window.scrollTo({ top: firstError.offsetTop - 100, behavior: 'smooth' });
                        }
                    } else {
                        // Server error or other error
                        let message = (data && data.message) ? data.message : 'An error occurred. Please try again.';
                        let globalErr = document.getElementById('form-global-error');
                        if (!globalErr) {
                            globalErr = document.createElement('div');
                            globalErr.id = 'form-global-error';
                            globalErr.style.color = 'red';
                            globalErr.style.margin = '10px 0';
                            globalErr.style.padding = '10px';
                            globalErr.style.backgroundColor = '#fee';
                            globalErr.style.border = '1px solid #fcc';
                            globalErr.style.borderRadius = '4px';
                            form.prepend(globalErr);
                        }
                        globalErr.innerText = message;
                    }
                })
                .catch(error => {
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = originalHtml;
                    let globalErr = document.getElementById('form-global-error');
                    if (!globalErr) {
                        globalErr = document.createElement('div');
                        globalErr.id = 'form-global-error';
                        globalErr.style.color = 'red';
                        globalErr.style.margin = '10px 0';
                        form.prepend(globalErr);
                    }
                    globalErr.innerText = 'An error occurred. Please try again.';
                });
            // END SUBMISSION LOGIC REWRITE
        });

        const fileInput = document.getElementById('property_images');
        if (fileInput) {
            fileInput.addEventListener('change', function () {
                const fileCount = this.files.length;
                const uploadButton = this.nextElementSibling;
                if (uploadButton && fileCount > 0) {
                    const firstSpan = uploadButton.querySelector('span:first-child');
                    if (firstSpan) {
                        firstSpan.textContent = `${fileCount} file(s) selected`;
                    }
                } else if (uploadButton) {
                    const firstSpan = uploadButton.querySelector('span:first-child');
                    if (firstSpan) {
                        firstSpan.textContent = 'Upload Images';
                    }
                }
            });
        }

        const allInputs = form.querySelectorAll('input, select, textarea');
        allInputs.forEach(input => {
            input.addEventListener('change', function () {
                this.style.borderColor = '';
                this.classList.remove('error-border');
                let group = this.parentElement;
                // Remove all error divs
                group.querySelectorAll('.validation-error, .field-error').forEach(div => {
                    div.remove();
                });
            });
            input.addEventListener('input', function () {
                this.style.borderColor = '';
                this.classList.remove('error-border');
                let group = this.parentElement;
                // Remove all error divs
                group.querySelectorAll('.validation-error, .field-error').forEach(div => {
                    div.remove();
                });
            });
        });

    });
</script>