class Form {
	/**
	 * Create a new Form instance.
	 */
	constructor(data) {
		this.originalData = data;
		for(let field in data) {
			this[field] = data[field];
		}

		this.errors = new Errors();
		this.isSubmitting = false
	}

	/**
	 * Reset the form fields.
	 */
	reset() {
		for(let field in this.originalData) {
			this[field] = '';
		}
		this.errors.clear();
	}

	/**
   * Fetch all input data of the form.
	 */
	data() {
		let data = {};

		for(let property in this.originalData) {
			data[property] = this[property];
		}

		return data;
	}

	/**
   * Send a POST request to the given URL.
   * 
   * @param {string} url
   */
  post(url) {
      return this.submit('post', url);
  }


  /**
   * Send a PUT request to the given URL.
   * 
   * @param {string} url
   */
  put(url) {
      return this.submit('put', url);
  }


  /**
   * Send a PATCH request to the given URL.
   * 
   * @param {string} url
   */
  patch(url) {
      return this.submit('patch', url);
  }


  /**
   * Send a DELETE request to the given URL.
   * 
   * @param {string} url
   */
  delete(url) {
      return this.submit('delete', url);
  }

	/**
	 * Submit the form
	 *
	 * @param {string} requestType
	 * @param {string} url
	 */
	submit(requestType, url) {
		return new Promise((resolve, reject) => {
			this.isSubmitting = true;
			axios[requestType](url, this.data())
					.then(response => { 
						this.onSuccess(response.data);
						resolve(response.data);
					})
					.catch(error => { 
						this.onFail(error.response.data);
						reject(error.response.data);
					});
		});
	}

	/**
	 * Handle a successful form submission
	 *
	 * @param {object} data
	 */
	onSuccess(data) {
		this.reset();
		this.isSubmitting = false;
	}

	/**
	 * Handle a failed form submission.
	 *
	 * @param {object} errors
	 */
	onFail(errors) {
		this.errors.record(errors);
		this.isSubmitting = false;
	}
}