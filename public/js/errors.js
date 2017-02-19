class Errors {
	/**
	 * Create a new Errors instance.
	 */
	constructor() {
		this.list = {};
	}

	/**
	 * Determine if we have any errors.
	 */
	any() {
		return Object.keys(this.list).length > 0;
	}

	/**
	 * Determine if an error exist for the given field.
	 *
	 * @param {string} field
	 */
	has(field) {
		return this.list.hasOwnProperty(field);
	}

	/**
	 * Retrieve the error message for a given field.
	 * 
	 * @param {string} field
	 */
	get(field) {
		if(this.list[field]) {
			return this.list[field][0];
		}
	}

	/**
	 * Record new errors.
	 *
	 * @param {object} errors
	 */
	record(errors) {
		this.list = errors;
	}

	/**
	 * Clear one or all error fields.
	 *
	 * @param {string|null} field
	 */
	clear(field) {
		if(field) {
			delete this.list[field];
			return;
		}

		this.list = {}
	}
}