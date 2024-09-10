import { afterEach, describe, expect, test, vi } from 'vitest'
import axios from 'axios'
import { AlertStyle } from '@userfrosting/sprinkle-core/types'
import { forgotPassword } from '../../composables'

const email: String = 'john.doe@example.com'

describe('forgotPassword.ts', () => {
    afterEach(() => {
        vi.clearAllMocks()
        vi.resetAllMocks()
    })

    test('Should send successfully', async () => {
        // Arrange
        const response = { data: { message: 'Mock message' } }
        vi.spyOn(axios, 'post').mockResolvedValue(response as any)

        // Act & Assert
        const result = await forgotPassword(email)
        expect(result).toEqual({
            description: 'Mock message',
            style: AlertStyle.Success,
            closeBtn: true
        })
        expect(axios.post).toHaveBeenCalledWith('/account/forgot-password', email)
    })

    test('Should handle errors', async () => {
        // Arrange
        const error = { response: { data: { description: 'Something failed' } } }
        vi.spyOn(axios, 'post').mockRejectedValue(error as any)

        // Act & Assert
        await expect(forgotPassword(email)).rejects.toEqual({
            description: 'Something failed',
            style: AlertStyle.Danger,
            closeBtn: true
        })
        expect(axios.post).toHaveBeenCalledWith('/account/forgot-password', email)
    })
})
