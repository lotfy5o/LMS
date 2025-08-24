<div class="lecture-overview-item">
    <form method="post">
        <div class="input-group mb-3">
            <input class="form-control form--control form--control-gray pl-3" type="text"
                name="search" placeholder="Search all course questions">
            <div class="input-group-append">
                <button class="btn theme-btn"><i class="la la-search search-icon"></i></button>
            </div>
        </div>
    </form>
    <div class="question-overview-filter-wrap d-flex align-items-center">
        <div class="question-overview-filter-item">
            <div class="select-container w-100">
                <select class="select-container-select">
                    <option value="0">All
                        lectures</option>
                    <option value="1">Current
                        lecture</option>
                </select>
            </div>
        </div>
        <!-- end question-overview-filter-item -->
        <div class="question-overview-filter-item">
            <div class="select-container w-100">
                <select class="select-container-select">
                    <option value="0">Sort by
                        most recent</option>
                    <option value="1">Sort by
                        most upvoted</option>
                    <option value="2">Sort by
                        recommended</option>
                </select>
            </div>
        </div>
        <!-- end question-overview-filter-item -->
        <div class="question-overview-filter-item">
            <div class="generic-action-wrap">
                <div class="dropdown">
                    <a class="btn theme-btn theme-btn-transparent w-100" href="#"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Filter questions
                    </a>
                    <div class="dropdown-menu">
                        <div class="dropdown-item">
                            <div class="custom-control custom-checkbox fs-15">
                                <input type="checkbox" class="custom-control-input"
                                    id="questionsCheckbox" required>
                                <label class="custom-control-label custom--control-label"
                                    for="questionsCheckbox">
                                    Questions I'm
                                    following
                                </label>
                            </div>
                            <!-- end custom-control -->
                        </div>
                        <div class="dropdown-item">
                            <div class="custom-control custom-checkbox fs-15">
                                <input type="checkbox" class="custom-control-input"
                                    id="questionsCheckbox2" required>
                                <label class="custom-control-label custom--control-label"
                                    for="questionsCheckbox2">
                                    Questions I
                                    asked
                                </label>
                            </div>
                            <!-- end custom-control -->
                        </div>
                        <div class="dropdown-item">
                            <div class="custom-control custom-checkbox fs-15">
                                <input type="checkbox" class="custom-control-input"
                                    id="questionsCheckbox3" required>
                                <label class="custom-control-label custom--control-label"
                                    for="questionsCheckbox3">
                                    Questions
                                    without
                                    responses
                                </label>
                            </div>
                            <!-- end custom-control -->
                        </div>
                    </div>
                </div>
            </div><!-- end generic-action-wrap -->
        </div>
        <!-- end question-overview-filter-item -->
    </div>
</div><!-- end lecture-overview-item -->
