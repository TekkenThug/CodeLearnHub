export const pluralize = (
  count: number,
  plural: string[]
) => {
  const lastTwoDigits = Math.abs(count) % 100

  if (lastTwoDigits >= 11 && lastTwoDigits <= 19) {
    return plural[2]
  }

  const lastDigit = lastTwoDigits % 10

  if (lastDigit === 1) {
    return plural[0]
  } else if (lastDigit >= 2 && lastDigit <= 4) {
    return plural[1]
  } else {
    return plural[2]
  }
}
